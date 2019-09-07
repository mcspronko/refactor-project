<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Test\Integration\Service\Http\Client;

use JournalMedia\Sample\Service\ContainerProvider;
use JournalMedia\Sample\Service\Http\Client\File;
use JournalMedia\Sample\Service\Http\TransferFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class FileTest
 */
class FileTest extends TestCase
{
    /**
     * @var File
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
        $this->transferFactory = $this->container->get('transfer.factory');

        $this->object = $this->container->get('client.file');
    }

    public function testSendAll()
    {
        $this->transferFactory->addUri('thejournal');
        $response = $this->object->send($this->transferFactory);

        $this->assertNotEmpty($response);
    }

    public function testSendById()
    {
        $this->transferFactory->addUri('thejournal/3625482');
        $response = $this->object->send($this->transferFactory);

        $this->assertNotEmpty($response);
    }
}
