<?php 
namespace App\Traits;

use App\Models\Subscription;

trait IncreaseProjectCountOnSubscription
{
    public function increaseProjectCountOnSubscription(Subscription $subscription)
    {
        $subscription->update([
            'submitted_projects_count' => $subscription->submitted_projects_count + 1
        ]);
    }
}