<?php

namespace Database\Seeders;

use App\Models\ConversationSubscription;
use Illuminate\Database\Seeder;

class ConversationSubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscriptions = [
            ['client_id' => 1800001, 'conversation_id' => 1],
            ['client_id' => 1800000, 'conversation_id' => 1]
        ];

        foreach ($subscriptions as $subscription) 
        {
            ConversationSubscription::create($subscription);
        }
    }
}
