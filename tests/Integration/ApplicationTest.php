<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Test\Integration;

use JournalMedia\Sample\Application;
use JournalMedia\Sample\Service\ContainerProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Zend\Diactoros\ServerRequestFactory;

/**
 * Class ApplicationTest
 */
class ApplicationTest extends TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    protected function setUp()
    {
        $this->container = ContainerProvider::getInstance();
        $this->container->setParameter(
            'twig.templates',
            BASE_PATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'view-html' . DIRECTORY_SEPARATOR
        );
    }

    public function testRun()
    {
        $application = new Application();

        ob_start();
        $application->run(ServerRequestFactory::fromGlobals());
        $htmlResponse = ob_get_clean();

        $this->assertContains('TheJournal.ie', $htmlResponse);
    }
}
