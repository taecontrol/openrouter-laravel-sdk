<?php

namespace Taecontrol\OpenRouter;

class OpenRouter
{
    protected OpenRouterConnector $connector;

    public function __construct(?string $token = null)
    {
        $this->connector = new OpenRouterConnector($token);
    }
}
