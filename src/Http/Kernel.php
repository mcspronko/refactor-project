<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http;

use League\Route\RouteCollection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

/**
 * Class Kernel
 */
class Kernel
{
    /** @var RouteCollection */
    private $routes;

    /**
     * Kernel constructor.
     * @param RouteCollection $routes
     */
    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->routes->dispatch($request, new Response);
    }
}
