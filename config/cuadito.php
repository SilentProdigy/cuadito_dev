<?php 

    return [
        'payment' => [
            'vat_percentage' => env('VAT_PERCENTAGE', 0),
            'default_billable_months_count' => env('DEFAULT_BILLABLE_MONTHS_COUNT', 12),
        ]
    ];