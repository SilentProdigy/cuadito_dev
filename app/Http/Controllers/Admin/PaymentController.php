<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['subscription', 'subscription.subscription_type']);

        if(request()->input('search'))
        {
            $payments = $payments->where(function($query) {
                $query->where('id', 'LIKE' , request()->input('search') ."%")
                ->orWhere('or_number', 'LIKE' , "%". request()->input('search') ."%")
                ->orWhere('status', 'LIKE' , "%". request()->input('search') ."%");
            });
        }   

        $payments = $payments->paginate();

        return view('admin.payments.index')->with(compact('payments'));
    }
    
    public function show(Payment $payment)
    {
        return view('admin.payments.show')->with(compact('payment'));
    }
}
