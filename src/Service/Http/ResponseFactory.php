<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service\Http;

use JournalMedia\Sample\Api\ResponseInterface;
use JournalMedia\Sample\Domain\Data\Response;

/**
 * Class ResponseFactory
 */
class ResponseFactory
{
    /**
     * @param array $articles
     * @param array $pagination
     * @return ResponseInterface
     */
    public function create(array $articles, array $pagination): ResponseInterface
    {
        return new Response($articles, $pagination);
    }
}
