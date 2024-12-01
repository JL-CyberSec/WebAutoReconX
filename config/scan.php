<?php

return [
    /*
    |--------------------------------------------------------------------------
    | FastAPI URI
    |--------------------------------------------------------------------------
    |
    | This is the URI of the FastAPI scan server.
    |
    */

    'fastapi_uri' => env('FASTAPI_URI', 'host.docker.internal:8000'),

    /*
    |--------------------------------------------------------------------------
    | FastAPI Endpoints
    |--------------------------------------------------------------------------
    |
    | These are the endpoints of the FastAPI scan server.
    |
    */

    'endpoints' => [
        'system-info',
        'interfaces',
        'firewall',
        'hosts/{timing}',
    ],
];