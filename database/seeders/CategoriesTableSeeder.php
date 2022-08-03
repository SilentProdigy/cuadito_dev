<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => "Office & Admin (VA)"],
            ['name' => "English & Writing"],
            ['name' => "Marketing & Sales"],
            ['name' => "Advertising"],
            ['name' => "Information Technology"],
            ['name' => "Engineering & Architecture"],
            ['name' => "Finance & Management"],
            ['name' => "Health"],
        ];

        foreach($categories as $category)
            Category::create($category);
    }
}
