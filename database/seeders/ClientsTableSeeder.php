<?php

namespace Database\Seeders;

use App\Models\Client;
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
            ]
        ];

        foreach($clients as $client)
        {
            Client::create($client);
        }
    }
}
