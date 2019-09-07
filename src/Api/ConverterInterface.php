<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Api;

use JournalMedia\Sample\Service\Http\ConverterException;

/**
 * Interface ConverterInterface
 * @api
 */
interface ConverterInterface
{
    /**
     * @param string|array $data
     * @return mixed
     * @throws ConverterException
     */
    public function convert($data);
}
