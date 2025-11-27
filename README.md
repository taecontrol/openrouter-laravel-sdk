# An OpenRouter SDK for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/taecontrol/openrouter-laravel-sdk.svg?style=flat-square)](https://packagist.org/packages/taecontrol/openrouter-laravel-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/taecontrol/openrouter-laravel-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/taecontrol/openrouter-laravel-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/taecontrol/openrouter-laravel-sdk/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/taecontrol/openrouter-laravel-sdk/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/taecontrol/openrouter-laravel-sdk.svg?style=flat-square)](https://packagist.org/packages/taecontrol/openrouter-laravel-sdk)

A lightweight, expressive Laravel wrapper around the [OpenRouter](https://openrouter.ai) API built on top of the excellent [Saloon](https://docs.saloon.dev/) HTTP client. It provides:

-   Simple methods for text completions and chat completions (with optional streaming)
-   Typed Data Objects for building requests and parsing responses
-   Configurable base URI, API token and timeouts
-   Support for reasoning & usage reporting parameters

## Requirements

-   PHP 8.2+
-   Laravel 10 or 11

## Installation

Install via Composer:

```bash
composer require taecontrol/openrouter-laravel-sdk
```

Publish the config (optional – only if you want to override defaults):

```bash
php artisan vendor:publish --tag="openrouter-laravel-sdk-config"
```

The published config file (`config/openrouter-laravel-sdk.php`):

```php
return [
    'base_uri' => 'https://openrouter.ai/api/v1',
    'token' => env('OPENROUTER_API_KEY', ''),
    'connect_timeout' => 10,
    'request_timeout' => 120,
];
```

Add your API key to `.env`:

```dotenv
OPENROUTER_API_KEY=sk-or-xxxxx
```

That's it. No migrations or views are shipped.

## Quick Start

Use the facade:

```php
use Taecontrol\OpenRouter\Facades\OpenRouter;
use Taecontrol\OpenRouter\DataObjects\CompletionsData;

$response = OpenRouter::completions(
    new CompletionsData(
        model: 'openai/gpt-3.5-turbo-instruct',
        prompt: 'Write a haiku about Laravel.'
    )
);

$text = $response->choices[0]->text; // string
```

Or resolve the class (easier to swap or test):

```php
use Taecontrol\OpenRouter\OpenRouter as OpenRouterClient;
use Taecontrol\OpenRouter\DataObjects\CompletionsData;

$client = app(OpenRouterClient::class);
$response = $client->completions(new CompletionsData(
    model: 'openai/gpt-3.5-turbo-instruct',
    prompt: 'Explain SOLID principles briefly.'
));
```

## Chat Completions

```php
use Taecontrol\OpenRouter\Facades\OpenRouter;
use Taecontrol\OpenRouter\DataObjects\ChatCompletionsData;
use Taecontrol\OpenRouter\DataObjects\ChatCompletionsMessageData;
use Taecontrol\OpenRouter\Enums\Role;

$data = new ChatCompletionsData(
    model: 'openai/gpt-4o-mini',
    messages: [
        ChatCompletionsMessageData::from([
            'role' => Role::User,
            'content' => 'Give me three Laravel testing tips.'
        ]),
    ],
    temperature: 0.7,
);

$response = OpenRouter::chatCompletions($data);

foreach ($response->choices as $choice) {
    $message = $choice->message; // ChatCompletionsMessageData
    echo $message->content . PHP_EOL;
}
```

## Streaming Chat Completions

Streams are returned as a PSR-7 StreamInterface. You can iterate chunks as they arrive (framework/event broadcasting omitted for brevity):

```php
use Taecontrol\OpenRouter\Facades\OpenRouter;
use Taecontrol\OpenRouter\DataObjects\ChatCompletionsData;
use Taecontrol\OpenRouter\DataObjects\ChatCompletionsMessageData;
use Taecontrol\OpenRouter\Enums\Role;

$stream = OpenRouter::chatCompletionsStream(
    new ChatCompletionsData(
        model: 'openai/gpt-4o-mini',
        messages: [
            ChatCompletionsMessageData::from([
                'role' => Role::User,
                'content' => 'Stream a short motivational quote word by word.'
            ]),
        ],
    )
);

while (!$stream->eof()) {
    $chunk = $stream->read(1024);
    if ($chunk !== '') {
        echo $chunk; // Each SSE/data chunk from OpenRouter
    }
}
```

## Embeddings

You can generate embeddings for text using the `embeddings` method:

```php
use Taecontrol\OpenRouter\Facades\OpenRouter;
use Taecontrol\OpenRouter\DataObjects\EmbeddingsData;
use Taecontrol\OpenRouter\Enums\EmbeddingEncodingFormat;

$data = new EmbeddingsData(
    input: 'The quick brown fox jumps over the lazy dog',
    model: 'text-embedding-ada-002',
    encodingFormat: EmbeddingEncodingFormat::Float, // Optional: Float or Base64
);

$response = OpenRouter::embeddings($data);

foreach ($response->data as $embeddingObject) {
    print_r($embeddingObject->embedding); // array of floats
    echo $embeddingObject->index; // int
}

// Usage statistics are also available
echo $response->usage->totalTokens;
```

## Request Data Objects

You construct strongly-typed request DTOs:

-   CompletionsData(model, prompt, reasoningData?, usageData?, maxTokens?, temperature?, seed?, topP?, topK?, user?)
-   ChatCompletionsData(model, messages[], reasoningData?, usageData?, maxTokens?, temperature?, seed?, topP?, topK?, user?)
-   ChatCompletionsMessageData(role, content, refusal?, reasoning?, reasoningDetails[]?)
-   EmbeddingsData(input, model, encodingFormat?, dimensions?, user?, provider?, inputType?)
-   ReasoningData(effort: Effort|null, maxTokens: string|null, exclude: bool|null)
-   UsageData(include: bool = false)

### Optional Parameters

| Parameter   | Purpose                                        |
| ----------- | ---------------------------------------------- |
| temperature | Controls randomness (float)                    |
| max_tokens  | Limit output tokens (int)                      |
| top_p       | Nucleus sampling (float)                       |
| top_k       | Limits token selection to top K (int)          |
| seed        | Determinism when supported (int)               |
| user        | End-user identifier string                     |
| reasoning   | Structured reasoning controls (ReasoningData)  |
| usage       | Ask API to include usage breakdown (UsageData) |

### Reasoning Effort Enum

Effort values come from `Taecontrol\OpenRouter\Enums\Effort` (e.g. `Effort::Low`, `Effort::Medium`, `Effort::High`).

### Roles Enum

Use `Taecontrol\OpenRouter\Enums\Role` (e.g. `Role::User`, `Role::Assistant`, `Role::System`).

## Responses

-   CompletionsResponse(id, choices[] CompletionsChoicesData)
-   ChatCompletionsResponse(id, choices[] ChatCompletionsChoiceData)
-   EmbeddingsResponseData(object, data[] EmbeddingObjectData, model, usage?)

Each ChatCompletionsChoiceData wraps a ChatCompletionsMessageData (so you always look at `$choice->message->content`).

## Dependency Injection / Custom Token

You can instantiate with a custom token (overrides config/env):

```php
use Taecontrol\OpenRouter\OpenRouter;
use Taecontrol\OpenRouter\DataObjects\CompletionsData;

$client = new OpenRouter(token: 'sk-alt-token');
$response = $client->completions(new CompletionsData(
    model: 'openai/gpt-3.5-turbo-instruct',
    prompt: 'Custom token example.'
));
```

## Timeouts

Configure in `config/openrouter-laravel-sdk.php`:

-   connect_timeout (default 10s)
-   request_timeout (default 120s)

## Testing

A basic test suite is included (Pest). Run:

```bash
composer test
```

You can mock the underlying Saloon connector or stub methods on the OpenRouter class when testing your application.

## Error Handling

All request methods may throw:

-   Saloon\Exceptions\Request\RequestException (HTTP level problems)
-   Saloon\Exceptions\Request\FatalRequestException (network/transport issues)
-   \Throwable (in edge cases such as JSON decoding)

Wrap calls as needed:

```php
try {
    $response = OpenRouter::completions(new CompletionsData(
        model: 'openai/gpt-3.5-turbo-instruct',
        prompt: 'Give me a tip.'
    ));
} catch (\Throwable $e) {
    report($e);
}
```

## Roadmap / Ideas

-   Add image generation endpoints when exposed
-   Add tools/function calling support if OpenRouter standardizes schema
-   Add automatic pagination helpers if needed

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Changelog

See [CHANGELOG](CHANGELOG.md).

## Security Vulnerabilities

Please review [our security policy](../../security/policy) for reporting guidelines.

## License

Released under the MIT License. See [LICENSE](LICENSE.md).
