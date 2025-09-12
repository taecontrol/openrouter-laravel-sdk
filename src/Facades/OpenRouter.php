<?php

namespace Taecontrol\OpenRouter\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Taecontrol\OpenRouter\OpenRouter
 */
class OpenRouter extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Taecontrol\OpenRouter\OpenRouter::class;
    }
}
