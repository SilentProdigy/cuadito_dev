<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = auth('client')->user()->payments()->paginate();

        return view('client.payments.index')->with(compact('payments'));
    }
}
