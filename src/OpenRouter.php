<?php

namespace Taecontrol\OpenRouter;

use Taecontrol\OpenRouter\Concerns\HandlesCompletions;

class OpenRouter
{
    use HandlesCompletions;

    protected OpenRouterConnector $connector;

    public function __construct(?string $token = null)
    {
        $this->connector = new OpenRouterConnector($token);
    }
}
