<?php 
namespace App\Traits;

use App\Models\Subscription;

trait DecreaseProposalCountOnSubscription
{
    public function decreaseProposalCountOnSubscription(Subscription $subscription)
    {
        if($subscription->submitted_proposals_count == 0)
            return;

        $subscription->update([
            'submitted_proposals_count' => $subscription->submitted_proposals_count - 1
        ]);
    }
}