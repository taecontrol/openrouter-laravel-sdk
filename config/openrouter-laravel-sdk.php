<?php

// config for Taecontrol/OpenRouter
return [
    'base_uri' => 'https://openrouter.ai/api/v1',
    'token' => env('OPENROUTER_API_KEY', ''),
    'connect_timeout' => 10,
    'request_timeout' => 120,
];
