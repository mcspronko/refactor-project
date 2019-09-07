<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Test\Integration\Service\Http\Client;

use JournalMedia\Sample\Service\ContainerProvider;
use JournalMedia\Sample\Service\Http\Client\Curl;
use JournalMedia\Sample\Service\Http\TransferFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class CurlTest
 */
class CurlTest extends TestCase
{
    /**
     * @var Curl
     */
    private $object;

    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @var TransferFactory
     */
    private $transferFactory;

    protected function setUp(): void
    {
        $this->container = ContainerProvider::getInstance();
        /** @var TransferFactory $transferFactory */
        $this->transferFactory = $this->container->get('curl.transfer.factory');

        $this->object = $this->container->get('client.curl');
    }

    public function testSendAll()
    {
        $this->transferFactory->addUri('sample/thejournal');
        $response = $this->object->send($this->transferFactory);

        $this->assertNotEmpty($response);
    }

    public function testSendById()
    {
        $this->transferFactory->addUri('article/3625482');
        $response = $this->object->send($this->transferFactory);

        $this->assertNotEmpty($response);
    }
}
