<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, Conversation $conversation)
    {
        $data = [
            'sender_id' => auth('client')->user()->id,
            'content' => $request->input('content')
        ];

        $conversation->messages()->create($data);
        return redirect()->back()->with('success', 'Message was successfully sent.');     
    }
}
