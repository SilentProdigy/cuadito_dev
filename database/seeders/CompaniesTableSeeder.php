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
        // $companies = [
        //     [
        //         'name' => 'JohnyDoe',
        //         'address' => 'Street Johny DOe',
        //         'email' => 'johnydoe-company.cuadito@gmail.com',
        //         'contact_number' => '09123123211',
        //     ]
        // ];

        $clients = Client::get();

        foreach ($clients as $client) {
            $companies = $this->generateDummyCompanies($client);

            foreach ($companies as $company) {
                $client->companies()->create($company);
            }
        }
    }

    public function generateDummyCompanies($client)
    {
        $companies = [];

        for ($i = 0; $i < 100; $i++) {
            $companies[] = [
                "name" => "Company-" . $client->name . "-" . $i,
                "address" => "Street " . $i . " York",
                "email" => "company" . $i . ".cuadito@gmail.com",
                "contact_number" => "09123123211",
                // 'validation_status' => (random_int(1, 10)) % 2 == 0 ? Company::APPROVED_STATUS : Company::FOR_APPROVAL_STATUS,
                "validation_status" => Company::APPROVED_STATUS,
            ];
        }

        return $companies;
    }
}
