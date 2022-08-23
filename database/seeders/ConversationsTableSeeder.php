<?php

namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Seeder;

class ConversationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conversations = [
            ['subject' => 'Lorem ipsum dulum']
        ];

        foreach($conversations as $conversation)
        {
            Conversation::create($conversation);
        }
    }
}
