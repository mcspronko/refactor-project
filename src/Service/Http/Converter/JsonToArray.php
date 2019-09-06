<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service\Http\Converter;

use JournalMedia\Sample\Api\ConverterInterface;

/**
 * Class JsonToArray
 */
class JsonToArray implements ConverterInterface
{
    public function convert($data)
    {
        return json_decode($data, true);
    }
}