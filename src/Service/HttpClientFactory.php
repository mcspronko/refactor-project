<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service;

use JournalMedia\Sample\Api\ClientInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class HttpClientFactory
 */
class HttpClientFactory
{
    /**
     * @var
     */
    private $isSandbox;

    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * HttpClientFactory constructor.
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $this->isSandbox = $environment->isSandbox();
        $this->container = ContainerProvider::getInstance();
    }

    /**
     * @return ClientInterface
     * @throws \Exception
     */
    public function create(): ClientInterface
    {
        $clientName = $this->isSandbox ? 'client.file' : 'client.curl';

        /** @var ClientInterface $client */
        $client = $this->container->get($clientName);

        return $client;
    }
}
