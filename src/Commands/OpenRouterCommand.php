<?php

namespace Taecontrol\OpenRouter\Commands;

use Illuminate\Console\Command;

class OpenRouterCommand extends Command
{
    public $signature = 'openrouter-laravel-sdk';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
