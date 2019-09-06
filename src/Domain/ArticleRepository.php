<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Domain;

use JournalMedia\Sample\Api\ArticleRepositoryInterface;
use JournalMedia\Sample\Api\Data\ArticleInterface;

/**
 * Class ArticleRepository
 */
class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * @var Resource
     */
    private $resource;

    public function getList()
    {
        // TODO: Implement getList() method.
    }

    /**
     * @param int|string $id
     * @return ArticleInterface
     */
    public function getById($id)
    {
        return $this->client->get();
    }
}
