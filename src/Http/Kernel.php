<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http;

use League\Route\RouteCollection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Exception;

/**
 * Class Kernel
 */
class Kernel
{
    /**
     * @var RouteCollection
     */
    private $routes;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * Kernel constructor.
     * @param RouteCollection $routes
     * @param ResponseInterface $response
     */
    public function __construct(
        RouteCollection $routes,
        ResponseInterface $response
    ) {
        $this->routes = $routes;
        $this->response = $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->routes->dispatch($request, $this->response);
    }
}
