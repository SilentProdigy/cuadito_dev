<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    private $userEmails = [
        'anthony.lopez@1mcdigital.com'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->userEmails as $email) {
            $user = User::where('email', '=', $email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => 'Admin',
                    'role' => 'admin',
                    'email' => 'admin.cuadito@gmail.com',
                    'password' => Hash::make('password'),
                    'status' => 1,
                ]);
            }
        }
    }
}
