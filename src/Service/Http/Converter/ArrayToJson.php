<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service\Http\Converter;

/**
 * Class ArrayToJson
 */
class ArrayToJson
{
    /**
     * @param array $content
     * @return string
     */
    public function convert(array $content): string
    {
        return json_encode($content);
    }
}
