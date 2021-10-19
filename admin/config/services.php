<?php

return [

    'github' => [
        'client_id' => '05dfa1f122b888383760',
        'client_secret' => '5e9cb7e15e9c87e3fa93e917313a3263d919042a',
        'redirect' => 'http://127.0.0.1:8000/GithubCallBack',
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
