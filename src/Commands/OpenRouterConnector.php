<?php

namespace Taecontrol\OpenRouter\Commands;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\HasTimeout;

class OpenRouterConnector extends Connector
{
    use HasTimeout;

    public function resolveBaseUrl(): string
    {
        return config('openrouter-laravel-sdk.base_uri');
    }

    public function getConnectTimeout(): float
    {
        return config('openrouter-laravel-sdk.connect_timeout');
    }

    public function getRequestTimeout(): float
    {
        return config('openrouter-laravel-sdk.request_timeout');
    }
}