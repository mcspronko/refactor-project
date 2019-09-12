<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class HtmlResponseFactory
 */
class HtmlResponseFactory
{
    /**
     * @var ContainerProvider
     */
    private $container;

    /**
     * HtmlResponseFactory constructor.
     */
    public function __construct()
    {
        $this->container = ContainerProvider::getInstance();
    }

    /**
     * @param string $response
     * @return ResponseInterface|HtmlResponse
     * @throws Exception
     */
    public function create($response)
    {
        $this->container->setParameter('html-response', $response);
        return $this->container->get('response.html.response');
    }
}
