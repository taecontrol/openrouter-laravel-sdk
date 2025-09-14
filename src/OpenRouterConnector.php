<?php

namespace Taecontrol\OpenRouter;

use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\HasTimeout;

class OpenRouterConnector extends Connector
{
    use HasTimeout;

    public function __construct(public readonly ?string $token) {}

    public function resolveBaseUrl(): string
    {
        return config('openrouter-laravel-sdk.base_uri');
    }

    public function defaultAuth(): TokenAuthenticator
    {
        $token = $this->token ?? config('openrouter-laravel-sdk.token');

        return new TokenAuthenticator($token);
    }

    public function getConnectTimeout(): float
    {
        return config('openrouter-laravel-sdk.connect_timeout');
    }

    public function getRequestTimeout(): float
    {
        return config('openrouter-laravel-sdk.request_timeout');
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }
}
