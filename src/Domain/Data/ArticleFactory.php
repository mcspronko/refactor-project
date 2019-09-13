<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Domain\Data;

use JournalMedia\Sample\Api\Data\ArticleInterface;

/**
 * Class ArticleFactory
 */
class ArticleFactory
{
    /**
     * @return ArticleInterface
     */
    public function create(): ArticleInterface
    {
        return new Article();
    }
}
