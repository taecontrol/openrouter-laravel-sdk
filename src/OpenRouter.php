<?php

namespace Taecontrol\OpenRouter;

use Taecontrol\OpenRouter\Concerns\HandlesChatCompletions;
use Taecontrol\OpenRouter\Concerns\HandlesCompletions;

class OpenRouter
{
    use HandlesChatCompletions;
    use HandlesCompletions;

    public function __construct(public ?string $token = null) {}

    public function connector(): OpenRouterConnector
    {
        return new OpenRouterConnector($this->token);
    }
}
