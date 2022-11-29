<?php 

namespace App\Traits;

use App\Models\Subscription;

trait DecreaseProjectCountOnSubscription 
{
    public function decreaseProjectCountOnSubscription(Subscription $subscription)
    {
        if($subscription->submitted_projects_count == 0)
            return;

        $subscription->update([
            'submitted_projects_count' => $subscription->submitted_projects_count - 1
        ]);
    }
}