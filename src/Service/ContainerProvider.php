<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
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
