<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service\Http\Client;

use JournalMedia\Sample\Api\ClientInterface;
use JournalMedia\Sample\Api\ConverterInterface;
use JournalMedia\Sample\Service\Http\ClientException;
use JournalMedia\Sample\Service\Http\ConverterException;
use JournalMedia\Sample\Service\Http\TransferFactory;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
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
     * @return array|mixed
     * @throws ClientException
     * @throws ConverterException|ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|TransportExceptionInterface
     */
    public function send(TransferFactory $transferFactory)
    {
        try {
            $transfer = $transferFactory->build();

            $response = $this->client->request(
                $transfer->getMethod(),
                $transfer->getUri(),
                [
                    'auth_basic' => [$transfer->getUsername(), $transfer->getPassword()],
                ]
            );
            $result = $response->getContent();
        } catch (\Exception $exception) {
            throw new ClientException('The error appeared during sending the request: ' . $exception->getMessage());
        }

        return $this->converter->convert($result);
    }
}
