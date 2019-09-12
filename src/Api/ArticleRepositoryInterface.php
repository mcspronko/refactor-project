<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Api;

use JournalMedia\Sample\Api\Data\ArticleInterface;

/**
 * Interface ArticleRepositoryInterface
 * @api
 */
interface ArticleRepositoryInterface
{
    /**
     * @return ArticleInterface[]
     */
    public function getList();

    /**
     * @param string|int $id
     * @return ArticleInterface
     */
    public function getById(int $id): ArticleInterface;

    public function getListByTag($tag);
}
