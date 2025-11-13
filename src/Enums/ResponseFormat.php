<?php

namespace Taecontrol\OpenRouter\Enums;

enum ResponseFormat: string
{
    case Text = 'text';
    case JsonObject = 'json_object';
    case JsonSchema = 'json_schema';
    case Grammar = 'grammar';
    case Python = 'python';
}
