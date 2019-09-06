<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service;

use JournalMedia\Sample\Service\Http\Client\File;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Config\FileLocator;

/**
 * Class Container
 */
class ContainerProvider
{
    /**
     * @var ContainerBuilder
     */
    private static $container;

    private function __construct()
    {}

    private static function init()
    {
        static::$container = new ContainerBuilder();

        $loader = new YamlFileLoader(static::$container, new FileLocator(__DIR__ . '/../..'));
        $loader->load('services.yaml');

//        static::$container->register('finder', Finder::class);

//        static::$container->setParameter('http.client.file.location', __DIR__ . '/../../resources/demo-responses/');
//        static::$container
//            ->register('client.file', File::class)
//            ->addArgument(new Reference('finder'))
//            ->addArgument('%http.client.file.location%');
    }

    /**
     * @return ContainerBuilder
     */
    public static function getInstance()
    {
        if (!static::$container) {
            static::init();
        }
        return static::$container;
    }
}
