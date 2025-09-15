<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

class ChatCompletionsChoiceData implements Arrayable
{
    public function __construct(
        public ChatCompletionsMessageData $message,
        public ?string $logProbs = null,
        public ?string $finishReason = null,
        public ?string $nativeFinishReason = null,
        public ?int $index = null,
    ) {}

    public static function from(array $data): self
    {
        return new self(
            message: ChatCompletionsMessageData::from(Arr::get($data, 'message')),
            logProbs: Arr::get($data, 'logprobs'),
            finishReason: Arr::get($data, 'finish_reason'),
            nativeFinishReason: Arr::get($data, 'native_finish_reason'),
            index: Arr::get($data, 'index'),
        );
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message->toArray(),
            'logprobs' => $this->logProbs,
            'finish_reason' => $this->finishReason,
            'native_finish_reason' => $this->nativeFinishReason,
            'index' => $this->index,
        ];
    }
}
