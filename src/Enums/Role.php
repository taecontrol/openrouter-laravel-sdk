<?php

namespace Taecontrol\OpenRouter\Enums;

enum Role: string
{
    case System = 'system';
    case Developer = 'developer';
    case User = 'user';
    case Assistant = 'assistant';
    case Tool = 'tool';
}
