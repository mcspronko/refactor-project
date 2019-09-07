<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service;

use JournalMedia\Sample\Api\Data\ArticleInterface;
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
     * @param Environment $environment
     * @throws Exception
     */
    public function __construct(
        HttpClientFactory $clientFactory,
        Environment $environment
    ) {
        $this->clientFactory = $clientFactory;

        $container = ContainerProvider::getInstance();
        $this->transferFactory = $environment->isSandbox() ?
            $container->get('transfer.factory') :
            $container->get('curl.transfer.factory');
    }

    /**
     * @param string $uri
     * @return ResponseInterface[]|[]
     */
    public function loadAll($uri)
    {
        try {
            $client = $this->clientFactory->create();
            $this->transferFactory->setUri('http://api.thejournal.ie/v3/' . $uri);
            return $client->send($this->transferFactory);
        } catch (Exception $exception) {
            return [];
        }
    }
}
