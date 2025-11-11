<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Configure the CORS settings that control how browsers and other HTTP
    | clients may interact with your API when calling from a different host.
    | Environment variables allow you to tailor the policy per deployment.
    |
    */

    'paths' => [
        'api/login-monitor',
        'sanctum/csrf-cookie',
    ],

    'allowed_methods' => explode(',', env('LOGIN_MONITOR_ALLOWED_METHODS', 'GET,POST,OPTIONS')),

    'allowed_origins' => array_filter(
        array_map('trim', explode(',', env('LOGIN_MONITOR_ALLOWED_ORIGINS', '*')))
    ),

    'allowed_origins_patterns' => [],

    'allowed_headers' => array_filter(
        array_map('trim', explode(',', env('LOGIN_MONITOR_ALLOWED_HEADERS', 'Content-Type,Accept,Origin,Authorization,X-Requested-With')))
    ),

    'exposed_headers' => array_filter(
        array_map('trim', explode(',', env('LOGIN_MONITOR_EXPOSED_HEADERS', '')))
    ),

    'max_age' => env('LOGIN_MONITOR_CORS_MAX_AGE', 600),

    'supports_credentials' => (bool) env('LOGIN_MONITOR_SUPPORTS_CREDENTIALS', false),

];