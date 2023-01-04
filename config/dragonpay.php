<?php 

return [
    'merchant_id'  => env('DRAGON_PAY_MERCHANT_ID'),
    'password' => env('DRAGON_PAY_MERCHANT_PASSWORD'),
    'base_url' => env('DRAGON_PAY_API_BASE_URL'),
    'currency' => 'PHP',
    'secret' => env('DRAGON_PAY_SHARED_SECRET'),
    'status_codes' => [
        'S' => 'Success',
        'F' => 'Failure',
        'P' => 'Pending',
        'U' => 'Unknown',
        'R' => 'Refund',
        'K' => 'Chargeback',
        'V' => 'Void',
        'A' => 'Authorized'
    ],
    'supported_payment_channels' => [
        'BDO',
        'BOG',
        'BPIA',
        'MBTC',
        'CBCB',
        'LBPA',
        'UBP5',
        'AAA',
        'BITC',
    ]
];