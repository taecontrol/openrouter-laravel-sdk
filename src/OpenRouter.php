<?php

namespace Taecontrol\OpenRouter;

use Taecontrol\OpenRouter\Concerns\HandlesChatCompletions;
use Taecontrol\OpenRouter\Concerns\HandlesCompletions;
use Taecontrol\OpenRouter\Concerns\HandlesEmbeddings;

class OpenRouter
{
    use HandlesChatCompletions;
    use HandlesCompletions;
    use HandlesEmbeddings;

    public function __construct(public ?string $token = null) {}

    public function connector(): OpenRouterConnector
    {
        return new OpenRouterConnector($this->token);
    }
}
