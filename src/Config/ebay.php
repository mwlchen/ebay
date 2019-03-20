<?php
return [
    'mode' => env('EBAY_MODE', 'sandbox'),
    'globalId' => env('EBAY_GLOBAL_ID','EBAY-AU'),
    'sandbox' => [
        'credentials' => [
            'devId' => env('EBAY_SANDBOX_DEV_ID'),
            'appId' => env('EBAY_SANDBOX_APP_ID'),
            'certId' => env('EBAY_SANDBOX_CERT_ID'),
        ],
        'authToken' => env('EBAY_SANDBOX_AUTH_TOKEN'),
        'oauthUserToken' => env('EBAY_SANDBOX_OAUTH_USER_TOKEN'),
    ],
    'production' => [
        'credentials' => [
            'devId' => env('EBAY_PROD_DEV_ID'),
            'appId' => env('EBAY_PROD_APP_ID'),
            'certId' => env('EBAY_PROD_CERT_ID'),
        ],
        'authToken' => env('EBAY_PROD_AUTH_TOKEN'),
        'oauthUserToken' => env('EBAY_PROD_OAUTH_USER_TOKEN'),
    ]
];