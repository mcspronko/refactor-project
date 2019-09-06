<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service;

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
     * @return array
     */
    public function loadAll($uri)
    {
        try {
            $client = $this->clientFactory->create();
            $this->transferFactory->setUri($uri);
            return $client->send($this->transferFactory);
        } catch (Exception $exception) {
            return [];
        }
    }
}
