<?php

namespace Database\Seeders;

use App\Models\Requirement;
use Illuminate\Database\Seeder;

class RequirementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requirements = [
            ['name' => "1pc Picture"],
            ['name' => "1pc Valid ID(Borrower)"],
            ['name' => "1pc Valid ID(Co-Maker)"],
            ['name' => "Business Permit"],
        ];

        foreach ($requirements as $item) 
            Requirement::create($item);
    }
}
