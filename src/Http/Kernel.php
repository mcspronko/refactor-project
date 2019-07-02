<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http;

use League\Route\RouteCollection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

class Kernel
{
    /** @var RouteCollection */
    private $routes;

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->routes->dispatch($request, new Response);
    }
}
