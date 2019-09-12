<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service\Http\Converter;

/**
 * Class ArrayToJson
 */
class ArrayToJson
{
    public function convert(array $content): string
    {
        return json_encode($content);
    }
}
