<?php

namespace Database\Seeders;

use App\Models\BidRule;
use Illuminate\Database\Seeder;

class BidRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BidRule::create([
            'min_project_cost' => 50000,
            'max_project_cost' => 100000,
            'percentage' => 0.1,
        ]);

        BidRule::create([
            'min_project_cost' => 100000,
            'max_project_cost' => 500000,
            'percentage' => 0.05,
        ]);

        BidRule::create([
            'min_project_cost' => 500000,
            'max_project_cost' => 1000000,
            'percentage' => 0.03,
        ]);

        BidRule::create([
            'min_project_cost' => 1000000,
            'max_project_cost' => 5000000,
            'percentage' => 0.02,
        ]);

        BidRule::create([
            'min_project_cost' => 5000000,
            'max_project_cost' => 10000000,
            'percentage' => 0.01,
        ]);

        BidRule::create([
            'min_project_cost' => 10000000,
            'max_project_cost' => 50000000,
            'percentage' => 0.0005,
        ]);

        BidRule::create([
            'min_project_cost' => 50000000,
            'max_project_cost' => 100000000,
            'percentage' => 0.0003,
        ]);

        BidRule::create([
            'min_project_cost' => 100000000,
            'max_project_cost' => 500000000,
            'percentage' => 0.0002,
        ]);

        BidRule::create([
            'min_project_cost' => 500000000,
            'max_project_cost' => 1000000000,
            'percentage' => 0.0001,
        ]);
    }
}
