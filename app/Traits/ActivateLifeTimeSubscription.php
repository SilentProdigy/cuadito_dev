<?php 

namespace App\Traits;

use App\Models\Subscription;

trait ActivateLifeTimeSubscription
{
    public function activateLifeTimeSubscription(Subscription $subscription)
    {
        $subscription->update([
            'expiration_date' => null
        ]);
    }
}