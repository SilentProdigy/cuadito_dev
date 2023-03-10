<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $fillable = [
        'payment_type_id',
        'amount',
        'additional_vat',
        'total_amount',
        'details',
        'paid_at',
        'period',
        'status',
        'client_id',
        'or_number',
        'reference_no',
        'payment_method',
    ];

    public $casts = [
        'paid_at' => 'datetime'
    ];

    const PAID_STATUS = "Success";
    const PENDING_STATUS = "Pending";


    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getInvoiceIdAttribute()
    {
        return "CPH" . $this->id;
    }
}
