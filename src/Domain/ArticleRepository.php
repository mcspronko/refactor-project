<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Domain;

use JournalMedia\Sample\Api\ArticleRepositoryInterface;
use JournalMedia\Sample\Api\Data\ArticleInterface;
use JournalMedia\Sample\Api\ResponseInterface;
use JournalMedia\Sample\Service\Resource;

/**
 * Class ArticleRepository
 */
class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * @var Resource
     */
    private $resource;

    /**
     * ArticleRepository constructor.
     * @param Resource $resource
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return ArticleInterface[]
     */
    public function getList(): array
    {
        /** @var ResponseInterface $response */
        $response = $this->resource->loadAll('sample/thejournal');
        return $response->getArticles();
    }

    /**
     * @param int $id
     * @return ArticleInterface
     */
    public function getById(int $id): ArticleInterface
    {
        /** @var ResponseInterface $response */
        $response = $this->resource->loadAll('article/' . $id);
        $articles = $response->getArticles();
        $article = reset($articles);

        return $article;
    }

    /**
     * @param string $tag
     * @return ArticleInterface[]
     */
    public function getListByTag($tag): array
    {
        /** @var ResponseInterface $response */
        $response = $this->resource->loadAll('sample/tag/' . $tag);
        return $response ? $response->getArticles() : [];
    }
}
