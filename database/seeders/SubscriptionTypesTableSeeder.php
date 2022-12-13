<?php

namespace Database\Seeders;

use App\Models\SubscriptionType;
use Illuminate\Database\Seeder;

class SubscriptionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'Silver',
                'amount' => 2000,
                'max_proposals_count' => 10,
                'max_projects_count' => 5,
            ], 
            [
                'name' => 'Gold',
                'amount' => 3000,
                'max_proposals_count' => 15,
                'max_projects_count' => 10,
            ], 
            [
                'name' => 'Platinum',
                'amount' => 4000,
                'max_proposals_count' => 20,
                'max_projects_count' => 15,
            ], 
        ])
        ->each(function($item) {
            SubscriptionType::create($item);
        });
    }
}
