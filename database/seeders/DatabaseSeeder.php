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
    private $userEmails = [
        'anthony.lopez@1mcdigital.com'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->userEmails as $email) {
            $user = User::where('email', '=', $email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => 'Anthony Mark Lopez',
                    'role' => 'admin',
                    'email' => 'anthony.lopez@1mcdigital.com',
                    'password' => Hash::make('password'),
                    'status' => 1,
                ]);
            }

            // $customer = Customer::create([
            //     'name' => 'Anh Vo ' . $user->id,
            //     'company' => 'CICT',
            //     'email' => 'anh@cict.solutions',
            // ]);

            // $address = Address::where('user_id', '=', $user->id)->first();

            // if (!$address) {
            //     DB::table('addresses')->insert([
            //         'name' => $user->name,
            //         'user_id' => $user->id,
            //         'customer_id' => $customer->id,
            //         'phone' => 123456789,
            //         'address' => '123 Cao Lo',
            //         'country' => 'VN',
            //         'state' => 'SG',
            //         'zipcode' => 700000
            //     ]);
            // }

            // $customer = Customer::create([
            //     'name' => 'Alex Colman',
            //     'company' => 'CICT',
            //     'email' => 'alex@cict.solutions',
            // ]);

            // DB::table('addresses')->insert([
            //     'name' => 'Alex Colman',
            //     'customer_id' => $customer->id,
            //     'phone' => 123456789,
            //     'address' => '123 Cao Lo',
            //     'country' => 'VN',
            //     'state' => 'SG',
            //     'zipcode' => 700000
            // ]);
        }

        for ($i = 1; $i <= 100; $i++) {
            DB::table('products')->insert([
                'name' => "Chicken Fried $i",
                'is_featured' => $i <= 5 ? 1 : 0,
                'price' => rand(10, 100),
                'cat_id' => rand(1, 5),
                'quantity' => 100,
                'unit' => 'KG',
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                'part' => 'P123',
                'model' => 'M123',
                'picture' => $this->generatePicture(),
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]);
        }

        for ($i = 1; $i <= 100; $i++) {
            DB::table('products')->insert([
                'name' => "Beef $i",
                'is_featured' => 0,
                'price' => rand(10, 100),
                'cat_id' => rand(1, 5),
                'quantity' => 100,
                'unit' => 'KG',
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                'part' => 'P123',
                'model' => 'M123',
                'picture' => $this->generatePictureBeef(),
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]);
        }

        for ($i = 1; $i <= 20; $i++) {
            DB::table('categories')->insert([
                'name' => "Menu $i",
                'parent_id' => $this->generateParentCatId($i),
                'ordering' => 0,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]);
        }
    }

    public function generatePictureBeef()
    {
        $pictures = [
            'https://i0.wp.com/www.onceuponachef.com/images/2016/12/Beef-Tenderloin-with-Red-Wine-Sauce-3.jpg?resize=760%2C597&ssl=1',
            'https://www.recipetineats.com/wp-content/uploads/2020/02/Steak-Marinade_4-SQ.jpg?w=500&h=500&crop=1',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgvy4XmJyNv_ordsY1ufXMulUEWJEWbI7_Lg&usqp=CAU',
            'https://fujifoods.vn/wp-content/uploads/2020/12/beef-steak-bo-toi-2.jpg',
        ];

        return $pictures[rand(0, 3)];
    }

    public function generatePicture()
    {
        $pictures = [
            'https://www.simplyrecipes.com/thmb/ZCFT9_ChypfZsVXbrkBYfdZHn9w=/2000x1333/filters:no_upscale():max_bytes(150000):strip_icc()/__opt__aboutcom__coeus__resources__content_migration__simply_recipes__uploads__2019__06__Spicy-Fried-Chicken-LEAD-1-e7cb02e138b24cde9f0d3eefc519f88b.jpg',
            'https://static.toiimg.com/thumb/61589069.cms?width=1200&height=900',
            'https://res.cloudinary.com/hsxfx8igq/image/upload/t_16x9_recipe_image,f_auto/v1624462106/vfjhjd6tfu0trzzbvcab.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSB47ehR_jvI7SgZyLPAhCgnyeo1akdmy7i9eph-z87Sd7Huff7Tfb5lcv6xbtKWDsmby8&usqp=CAU',
        ];

        return $pictures[rand(0, 3)];
    }

    public function  generateParentCatId($i)
    {
        if ($i <= 5) {
            return 0;
        }

        if ($i > 5 && $i <= 10) {
            return $i - 5;
        }

        if ($i > 10 && $i <= 15) {
            return $i - 10;
        }

        if ($i > 15 && $i <= 20) {
            return $i - 15;
        }
    }
}
