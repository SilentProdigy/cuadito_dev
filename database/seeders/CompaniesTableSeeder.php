<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $companies = $this->generateDummyCompanies();

        // $companies = [
        //     [
        //         'name' => 'JohnyDoe',
        //         'address' => 'Street Johny DOe',
        //         'email' => 'johnydoe-company.cuadito@gmail.com',
        //         'contact_number' => '09123123211',
        //     ]
        // ];

        $client = Client::first();

        foreach($companies as $company)
            $client->companies()->create($company);
    }

    public function generateDummyCompanies()
    {
        $companies = [];

        for($i = 0; $i < 5; $i++)
        {
            $companies[] = [
                'name' => 'Company ' . $i,
                'address' => 'Street ' . $i . ' York',
                'email' => 'company'.$i.'.cuadito@gmail.com',
                'contact_number' => '09123123211',
            ];
        }

        return $companies;
    }
}
