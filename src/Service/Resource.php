<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service;

use JournalMedia\Sample\Api\ResponseInterface;
use JournalMedia\Sample\Service\Http\TransferFactory;
use Exception;

/**
 * Class Resource
 */
class Resource
{
    /**
     * @var HttpClientFactory
     */
    private $clientFactory;

    /**
     * @var TransferFactory
     */
    private $transferFactory;

    /**
     * Resource constructor.
     * @param HttpClientFactory $clientFactory
     * @param TransferFactory $transferFactory
     */
    public function __construct(
        HttpClientFactory $clientFactory,
        TransferFactory $transferFactory
    ) {
        $this->clientFactory = $clientFactory;
        $this->transferFactory = $transferFactory;
    }

    /**
     * @param string $uri
     * @return ResponseInterface[]|[]
     */
    public function loadAll($uri)
    {
        try {
            $client = $this->clientFactory->create();
            $this->transferFactory->addUri($uri);
            return $client->send($this->transferFactory);
        } catch (Exception $exception) {
            return [];
        }
    }
}
