<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bidding extends Model
{
    use HasFactory, SoftDeletes;

    public const DEFAULT_DECREASE_VALUE = 10;

    protected $with = ['company'];

    protected $fillable = [
        'company_id',
        'project_id',
        // 'quotation_url',
        'cover_letter',
        'rate',
        'is_paid'
    ];

    public function payment()
    {
        return $this->morphOne(Payment::class, 'paymentable');
    }

    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class);
    }

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function attachments()
    {
        return $this->morphMany(\App\Models\Attachment::class, 'attachmentable');
    }

    public function getIsOwnedAttribute()
    {
        return $this->company->client_id == auth('client')->user()->id;
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    static function getOwner(string $proposal_id)
    {
        $proposal = self::where(['id' => $proposal_id])->firstOrFail();
        return $proposal->company->client;
    }

    static function createNotificationsForProposal(Bidding $proposal)
    {
        $project = $proposal->project;

        $proposal->notifications()->create([
            'client_id' => auth('client')->user()->id,
            'content' => "You submitted a proposal for Project: " . $project->title . " #" . $project->id,
            'url' => route('client.proposals.show', $proposal),
        ]);
    
        $proposal->notifications()->create([
            'client_id' => $project->owner->id,
            'content' => $proposal->company->name . " submitted a proposal for your Project: " . $project->title . " #" . $project->id,
            'url' => route('client.projects.show', $project),                
        ]);
    }

    static function cancelProposal(Bidding $bidding)
    {
        # Delete notifications
        $bidding->notifications()->each(function($item) {
            $item->delete();
        });

        $bidding->delete();
    }

    public function markAsPaid()
    {
        self::update(['is_paid' => true]);
    }

    public function requirements()
    {
        return $this->hasMany(BiddingRequirement::class);
    }
}
