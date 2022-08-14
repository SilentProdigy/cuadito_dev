<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = auth('client')->user()->conversations;
        
        return view('client.conversations.index')->with(compact('conversations'));
    }
}
