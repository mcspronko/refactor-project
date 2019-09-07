<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Api;

use JournalMedia\Sample\Api\Data\ArticleInterface;

/**
 * Interface ResponseInterface
 * @api
 */
interface ResponseInterface
{
    /**
     * @return ArticleInterface[]
     */
    public function getArticles();

    /**
     * @return array
     */
    public function getPagination();
}
