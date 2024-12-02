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
        'System Information' => 'system-info',
        'Interfaces' => 'interfaces',
        'Firewall' => 'firewall',
        'Hosts' => 'hosts/{timing}',
    ],

    /*
    |--------------------------------------------------------------------------
    | Use IA
    |--------------------------------------------------------------------------
    |
    | This is whether to use IA or not.
    |
    */

    'use_ia' => env('USE_IA', false),

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key
    |--------------------------------------------------------------------------
    |
    | This is the API key for the OpenAI API.
    |
    */

    'openai_api_key' => env('OPENIA_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Prompt
    |--------------------------------------------------------------------------
    |
    | This is the prompt for the OpenAI API.
    |
    */

    'prompt' => 'I have this JSON with security scan results that can include system, interfaces, firewall, and host information. Please analyze the data and provide security recommendations, focusing on prioritizing critical vulnerabilities, proposing practical mitigation steps, and enhancing overall system security based on the scan findings: {data}.',
];