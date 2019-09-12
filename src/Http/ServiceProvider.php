<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http;

use Illuminate\Container\Container;
use JournalMedia\Sample\Http\Controller\ArticleController;
use JournalMedia\Sample\Http\Controller\PublicationRiverController;
use JournalMedia\Sample\Http\Controller\TagRiverController;
use League\Route\RouteCollection;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class ServiceProvider
 */
class ServiceProvider
{
    private static $container;

    public function register(Container $container): void
    {
        $container->singleton(RouteCollection::class, function ($container) {
            $route = new RouteCollection;

            $route->get("/", $container[PublicationRiverController::class]);
            $route->get("/tag/{tag}", $container[TagRiverController::class]);
            $route->get("/article/{id}", $container[ArticleController::class]);

            return $route;
        });

        $container->singleton(Environment::class, function ($container) {
            $loader = new FilesystemLoader(__DIR__ . '/../../src/view-html/');
            $twig = new Environment($loader, [
                'cache' => __DIR__ . '/../../tmp/cache',
            ]);

            return $twig;
        });

        static::$container = $container;
    }

    /**
     * @return ContainerBuilder
     */
    public static function getInstance()
    {
        return static::$container;
    }
}
