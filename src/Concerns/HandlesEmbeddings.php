<?php

namespace Taecontrol\OpenRouter\Concerns;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Taecontrol\OpenRouter\DataObjects\EmbeddingsData;
use Taecontrol\OpenRouter\DataObjects\EmbeddingsResponseData;
use Taecontrol\OpenRouter\OpenRouter;
use Taecontrol\OpenRouter\Requests\EmbeddingsRequest;
use Throwable;

/**
 * @mixin OpenRouter
 */
trait HandlesEmbeddings
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     * @throws Throwable
     */
    public function embeddings(EmbeddingsData $data): EmbeddingsResponseData
    {
        $response = $this->connector()->send(new EmbeddingsRequest($data))->throw();

        return $response->dtoOrFail();
    }
}
