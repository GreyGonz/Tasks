<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    /*
    | Acacha Llum services...
    |
    | See: https://github.com/acacha/llum
    |
    */
    #llum_services

    'google' => [
        'client_id' => env('GOOGLE_OAUTH_APP_ID'),
        'client_secret' => env('GOOGLE_OAUTH_APP_SECRET'),
        'redirect' => env('GOOGLE_OAUTH_APP_REDIRECT_URL'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_OAUTH_APP_ID'),
        'client_secret' => env('GOOGLE_OAUTH_APP_SECRET'),
        'redirect' => env('GOOGLE_OAUTH_APP_REDIRECT_URL'),
    ],

    'github' => [
        'client_id' => env('GITHUB_OAUTH_APP_ID'),
        'client_secret' => env('GITHUB_OAUTH_APP_SECRET'),
        'redirect' => env('GITHUB_OAUTH_APP_REDIRECT_URL'),
    ],

    'github' => [
        'client_id' => env('GITHUB_OAUTH_APP_ID'),
        'client_secret' => env('GITHUB_OAUTH_APP_SECRET'),
        'redirect' => env('GITHUB_OAUTH_APP_REDIRECT_URL'),
    ],

    'github' => [
        'client_id' => env('GITHUB_OAUTH_APP_ID'),
        'client_secret' => env('GITHUB_OAUTH_APP_SECRET'),
        'redirect' => env('GITHUB_OAUTH_APP_REDIRECT_URL'),
    ],


    /*
    | Acacha Llum services...
    |
    | See: https://github.com/acacha/llum
    |
    */
    //llum_services

];
