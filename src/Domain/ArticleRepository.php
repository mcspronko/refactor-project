<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Domain;

use JournalMedia\Sample\Api\ArticleRepositoryInterface;
use JournalMedia\Sample\Api\Data\ArticleInterface;
use JournalMedia\Sample\Api\ResponseInterface;
use JournalMedia\Sample\Service\ContainerProvider;
use JournalMedia\Sample\Service\Resource;
use Symfony\Component\DependencyInjection\ContainerBuilder;

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
     * @var ContainerBuilder
     */
    private $container;

    /**
     * ArticleRepository constructor.
     * @param Resource $resource
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
        $this->container = ContainerProvider::getInstance();
    }

    /**
     * @return ArticleInterface[]
     */
    public function getList(): array
    {
        $response = $this->resource->loadAll('sample/thejournal');
        return $response->getArticles();
    }

    /**
     * @param int|string $id
     * @return ResponseInterface
     */
    public function getById($id)
    {
        $response = $this->resource->loadAll('article/' . $id);
        $articles = $response->getArticles();
        $article = reset($articles);

        return $article;
    }
}
