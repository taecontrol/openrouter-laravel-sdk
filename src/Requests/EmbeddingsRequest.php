<?php

namespace Taecontrol\OpenRouter\Requests;

use JsonException;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use Taecontrol\OpenRouter\DataObjects\EmbeddingsData;
use Taecontrol\OpenRouter\DataObjects\EmbeddingsResponseData;

class EmbeddingsRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(public readonly EmbeddingsData $data)
    {
    }

    public function resolveEndpoint(): string
    {
        return '/embeddings';
    }

    protected function defaultBody(): array
    {
        return $this->data->toArray();
    }

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): EmbeddingsResponseData
    {
        $data = $response->json();

        return EmbeddingsResponseData::from($data);
    }
}
