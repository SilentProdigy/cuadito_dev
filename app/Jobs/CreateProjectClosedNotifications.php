<?php

namespace App\Jobs;

use App\Models\Project;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateProjectClosedNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $project;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try 
        {
            $this->project->proposals->each(function($proposal) {
                $company_owner = $proposal->company->client;

                $company_owner->notifications()->create([
                    'content' => $proposal->project->title . " - #ID " . $proposal->project->id . " was CLOSED by the owner.",
                    'url' => route('client.proposals.show', $proposal),    
                ]);
            }); 
            
            Log::info('Created Closed Notifications for PROJECT #ID ' . $this->project->id);
        }
        catch(Exception $e)
        {
            Log::error('Operation Failed: ' . $e->getMessage());
        }
    }
}
