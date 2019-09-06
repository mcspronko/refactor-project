<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service\Http\Client;

use JournalMedia\Sample\Api\ClientInterface;
use JournalMedia\Sample\Api\ConverterInterface;
use JournalMedia\Sample\Service\Http\TransferFactory;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class Curl
 */
class Curl implements ClientInterface
{
    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @var ConverterInterface
     */
    private $converter;

    /**
     * Curl constructor.
     * @param HttpClientInterface $client
     * @param ConverterInterface $converter
     */
    public function __construct(
        HttpClientInterface $client,
        ConverterInterface $converter
    ) {
        $this->converter = $converter;
        $this->client = $client;
    }

    /**
     * @param TransferFactory $transferFactory
     * @return array|string
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function send(TransferFactory $transferFactory)
    {
        $transfer = $transferFactory->build();

        $response = $this->client->request(
            $transfer->getMethod(),
            $transfer->getUri(),
            [
                'auth_basic' => [$transfer->getUsername(), $transfer->getPassword()],
            ]
        );

        $result = $response->getContent();

        return $this->converter->convert($result);
    }
}
