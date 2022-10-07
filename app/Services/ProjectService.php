<?php 

namespace App\Services;

use App\Jobs\CreateProjectClosedNotifications;
use App\Mail\Project\ProjectClosed;
use App\Mail\Project\ProposalApproved;
use App\Mail\Project\ProposalDisapproved;
use App\Models\Bidding;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;

class ProjectService 
{
    public function createProject(Company $company, $project_details, $category_ids)
    {
        $project = $company->projects()->create($project_details);
        $project->categories()->sync($category_ids);
        return $project;
    }

    public function updateProject(Project $project, $project_details, $category_ids)
    {
        $project->update($project_details);
        $this->syncCategories($project, $category_ids);
        return $project;
    }

    public function syncCategories(Project $project, $category_ids)
    {
        $project->categories()->sync($category_ids);
    }

    public function setWinner(Project $project, $data)
    {
        $winning_proposal = Bidding::findOrFail($data['winner_bidding_id']);
        $winning_company = $winning_proposal->company;

        $project->update([
            'status' => Project::CLOSED_STATUS,
            'remarks' => $data['remarks'], 
            'winner_bidding_id' => $winning_proposal->id
        ]);

        CreateProjectClosedNotifications::dispatch($project);

        $emails = $project->biddings->pluck('company.email')->toArray();
        $did_not_win_emails = $project->biddings()->where('id', '!=', $winning_proposal->id)
                            ->get()
                            ->pluck('company.email')
                            ->toArray();

        # Sending emails & notifications
        $this->sendProjectClosedEmails($emails, $project);
        $this->sendEmailToProjectWinner($winning_company->email, $project);
        $this->sendEmailsToLosers($did_not_win_emails, $project);
        $this->createNotificationToWinningClient($winning_company, $project);
    }

    private function createNotificationToWinningClient(Company $company, Project $project)
    {
        $company->client->notifications()->create([
            'content' => "Congratulations! Your proposal for Project - " . $project->title . " - #ID " . $project->id . " was selected!",
            'url' => route('client.projects.show', $project),
        ]);
    }

    private function sendEmailToProjectWinner($email, Project $project)
    {
        $this->sendEmail($email, new ProposalApproved($project));
    }

    private function sendProjectClosedEmails($receiving_emails, Project $project)
    {
        $this->sendEmail($receiving_emails, new ProjectClosed($project));
    }

    private function sendEmailsToLosers($receiving_emails, Project $project)
    {
        $this->sendEmail($receiving_emails, new ProposalDisapproved($project));
    }

    private function sendEmail($receiving_emails, $mailable)
    {
        Mail::to($receiving_emails)->send($mailable);
    }
}
