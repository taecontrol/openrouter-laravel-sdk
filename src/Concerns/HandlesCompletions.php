<?php

namespace Taecontrol\OpenRouter\Concerns;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Taecontrol\OpenRouter\CompletionsRequest;
use Taecontrol\OpenRouter\DataObjects\CompletionsData;
use Taecontrol\OpenRouter\OpenRouter;
use Throwable;

/**
 * @mixin OpenRouter
 */
trait HandlesCompletions {
    /**
     * @throws FatalRequestException
     * @throws RequestException
     * @throws Throwable
     */
    public function completions(CompletionsData $data)
    {
        $response = $this->connector->send(new CompletionsRequest($data))->throw();

    }
}
