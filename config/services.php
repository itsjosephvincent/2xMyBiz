<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'bitbucket' => [
        'active' => env('BITBUCKET_ACTIVE'),
        'client_id' => env('BITBUCKET_CLIENT_ID'),
        'client_secret' => env('BITBUCKET_CLIENT_SECRET'),
        'redirect' => env('BITBUCKET_REDIRECT'),
        'scopes' => ['manage_pages'],
        'with' => [],
    ],

    'facebook' => [
        'active' => env('FACEBOOK_ACTIVE'),
        'client_id' => env('FACEBOOK_LOGIN_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_LOGIN_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_LOGIN_REDIRECT'),
        'scopes' => [],
        'with' => [],
        'fields' => ['id', 'first_name', 'last_name', 'email'],
    ],

    'github' => [
        'active' => env('GITHUB_ACTIVE'),
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => env('GITHUB_REDIRECT'),
        'scopes' => [],
        'with' => [],
    ],

    'google' => [
        'active' => env('GOOGLE_ACTIVE'),
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),
        'scopes' => [],
        'with' => [],
    ],

    'linkedin' => [
        'active' => env('LINKEDIN_ACTIVE'),
        'client_id' => env('LINKEDIN_CLIENT_ID'),
        'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
        'redirect' => env('LINKEDIN_REDIRECT'),
        'scopes' => ['r_emailaddress', 'openid', 'profile', 'r_liteprofile', 'w_member_social', 'email'],
        'with' => [],
        'fields' => [],
    ],

    'twitter' => [
        'active' => env('TWITTER_ACTIVE'),
        'client_id' => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect' => env('TWITTER_REDIRECT'),
        'scopes' => [],
        'with' => [],
    ],
];
