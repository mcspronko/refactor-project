<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Api;

use JournalMedia\Sample\Service\Http\TransferFactory;

/**
 * Interface ClientInterface
 * @api
 */
interface ClientInterface
{
    /**
     * @param TransferFactory $transferFactory
     * @return array
     */
    public function send(TransferFactory $transferFactory);
}
