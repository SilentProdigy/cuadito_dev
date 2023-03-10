<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Address;
use App\Models\Customer;

class DatabaseSeeder extends Seeder
{
    

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // $this->call(SubscriptionTypesTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(RequirementsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        
        // $this->call(ConversationsTableSeeder::class);
        // $this->call(ConversationSubscriptionsTableSeeder::class);
    }
}
