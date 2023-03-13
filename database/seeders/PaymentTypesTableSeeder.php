<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypesTableSeeder extends Seeder
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
                'amount' => '5000',
                'name' => 'Proposal fee',
                'description' => 'Payment for submitting a proposal'
            ],
            [
                'amount' => '10000',
                'name' => 'Viewing of proposals fee',
                'description' => "Payment for viewing of project's a proposal"
            ]
        ])
        ->each(function($item) {
            PaymentType::create($item);
        });
    }
}
