<?php

namespace Taecontrol\OpenRouter\Concerns;

use Psr\Http\Message\StreamInterface;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Taecontrol\OpenRouter\DataObjects\CompletionsData;
use Taecontrol\OpenRouter\DataObjects\CompletionsResponse;
use Taecontrol\OpenRouter\OpenRouter;
use Taecontrol\OpenRouter\Requests\CompletionsRequest;
use Taecontrol\OpenRouter\Requests\CompletionsStreamRequest;
use Throwable;

/**
 * @mixin OpenRouter
 */
trait HandlesCompletions
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     * @throws Throwable
     */
    public function completions(CompletionsData $data): CompletionsResponse
    {
        $response = $this->connector()->send(new CompletionsRequest($data))->throw();

        return $response->dtoOrFail();
    }

    /**
     * @throws FatalRequestException
     * @throws Throwable
     * @throws RequestException
     */
    public function completionsStream(CompletionsData $data): StreamInterface
    {
        $response = $this->connector()->send(new CompletionsStreamRequest($data))->throw();

        return $response->stream();
    }
}
