<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service;

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class HtmlResponseFactory
 */
class HtmlResponseFactory
{
    /**
     * @param $response
     * @return ResponseInterface
     */
    public function create($response): ResponseInterface
    {
        return new HtmlResponse($response);
    }
}
