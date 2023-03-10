<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'amount'
    ];

    public const PAYMENT_FOR_PROPOSAL_ID = 1;
    public const PAYMENT_FOR_PROPOSALS_LIST_ID = 2;

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
