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
                'points' => 100
            ], 
            [
                'name' => 'Gold',
                'amount' => 3000,
                'points' => 200
            ], 
            [
                'name' => 'Platinum',
                'amount' => 4000,
                'points' => 300
            ], 
        ])
        ->each(function($item) {
            SubscriptionType::create($item);
        });
    }
}
