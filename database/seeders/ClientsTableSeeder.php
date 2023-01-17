<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            [
                'name' => 'John Doe',
                'gender' => 'MALE',
                'address' => 'Washington DC',
                'marital_status' => 'Single',
                'email' => 'johndoe.cuadito@gmail.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Brian Calma',
                'gender' => 'MALE',
                'address' => 'Washington DC',
                'marital_status' => 'Single',
                'email' => 'briancalmadevacc@gmail.com',
                'password' => bcrypt('password')
            ]
        ];

        foreach($clients as $client)
        {
            $newly_created_client = Client::create($client);

            $plan = SubscriptionType::first();

            $expiration_date = new Carbon();
            $expiration_date = $expiration_date->addYear();

            $subscription = $newly_created_client->subscriptions()->create([
                'subscription_type_id' => $plan->id,
                'status' => Subscription::ACTIVE_STATUS,
                'submitted_proposals_count' => 0,
                'submitted_projects_count' => 0,
                'expiration_date' => $expiration_date
            ]);

            $payment = $subscription->payments()->create([
                'amount' => 0, // amount here comes from the api of dragon pay
                'total_amount' => 0,
                'details' => 'Payment for ' . $subscription->subscription_type->name . ' plan',                
                'period' =>  "12 months",
                'status' => Payment::PAID_STATUS,
                'client_id' => $newly_created_client->id
            ]);

        }
    }
}
