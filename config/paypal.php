<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>
 */

return [
    'mode' => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username' => 'cmrabet_api1.softelos.com',
        'password' => 'Y4AH3295CPCHS3QN',
        'secret' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31Ao85QahUFTGamvHjrmLagDQv.RjP',
        'certificate' => '',
    ],
    'live' => [
        'username' => '',
        'password' => '',
        'secret' => '',
        'certificate' => '',
    ],

    'payment_action' => 'Sale', // Can Only Be 'Sale', 'Authorization', 'Order'
    'currency' => 'USD',
    'notify_url' => '/paypal/notify', // Change this accordingly for your application.
];