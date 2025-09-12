<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;

class UsageData implements Arrayable
{
    public function __construct(
        public bool $include = false,
    ) {}

    public function toArray(): array
    {
        return [
            'include' => $this->include,
        ];
    }
}