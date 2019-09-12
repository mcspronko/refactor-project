<?php
declare(strict_types=1);

namespace JournalMedia\Sample;

use Illuminate\Container\Container;
use JournalMedia\Sample\Http\Kernel;
use JournalMedia\Sample\Http\ServiceProvider;
use Illuminate\Contracts\Container\BindingResolutionException;
use JournalMedia\Sample\Service\ContainerProvider;
use Psr\Http\Message\ServerRequestInterface;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

/**
 * Class Application
 */
class Application
{
    /**
     * @var Container
     */
    private $container;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->container = ContainerProvider::getInstance();
    }

    /**
     * @param ServerRequestInterface $request
     * @throws \Exception
     */
    public function run(ServerRequestInterface $request)
    {
        /** @var SapiEmitter $sapiEmitter */
        $sapiEmitter = $this->container->get('emitter');

        /** @var Kernel $kernel */
        $kernel = $this->container->get('kernel');

        $sapiEmitter->emit($kernel->handle($request));
    }
}
