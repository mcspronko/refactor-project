<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Api;

interface ConverterInterface
{
    /**
     * @param string|array $data
     * @return string|array
     */
    public function convert($data);
}
