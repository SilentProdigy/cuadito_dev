<?php 
namespace App\Traits;

use App\Models\Subscription;

trait IncreaseProposalCountOnSubscription
{
    public function increaseProposalCountOnSubscription(Subscription $subscription)
    {
        $subscription->update([
            'submitted_proposals_count' => $subscription->submitted_proposals_count + 1
        ]);
    }
}

