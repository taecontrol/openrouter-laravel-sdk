<?php

namespace Taecontrol\OpenRouter\Concerns;

use Psr\Http\Message\StreamInterface;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Taecontrol\OpenRouter\DataObjects\ChatCompletionsData;
use Taecontrol\OpenRouter\DataObjects\ChatCompletionsResponse;
use Taecontrol\OpenRouter\OpenRouter;
use Taecontrol\OpenRouter\Requests\ChatCompletionsRequest;
use Taecontrol\OpenRouter\Requests\ChatCompletionsStreamRequest;
use Throwable;

/**
 * @mixin OpenRouter
 */
trait HandlesChatCompletions
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     * @throws Throwable
     */
    public function chatCompletions(ChatCompletionsData $data): ChatCompletionsResponse
    {
        $response = $this->connector->send(new ChatCompletionsRequest($data))->throw();

        return $response->dtoOrFail();
    }

    /**
     * @throws FatalRequestException
     * @throws Throwable
     * @throws RequestException
     */
    public function chatCompletionsStream(ChatCompletionsData $data): StreamInterface
    {
        $response = $this->connector->send(new ChatCompletionsStreamRequest($data))->throw();

        return $response->stream();
    }
}
