<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Domain;

use JournalMedia\Sample\Api\ArticleRepositoryInterface;
use JournalMedia\Sample\Api\Data\ArticleInterface;
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
        $result = $this->resource->loadAll('thejournal');

        $items = [];
        foreach ($result as $item) {
            try {
                /** @var ArticleInterface $article */
                $article = $this->container->get('article');
                $article->setId($this->getValue('id', $item));
                $article->setTitle($this->getValue('title', $item));
                $article->setDate($this->getValue('date', $item));
                $article->setSlug($this->getValue('slug', $item));
                $article->setContent($this->getValue('content', $item));
                $article->setImages($this->getValue('images', $item));
                $article->setTags($this->getValue('tags', $item));

                $items[$article->getId()] = $article;
            } catch (\Exception $exception) {
                //@TODO log exception
            }
        }

        return $items;
    }

    /**
     * @param string $key
     * @param array $array
     * @param string $default
     * @return string
     */
    private function getValue($key, &$array, $default = '')
    {
        return isset($array[$key]) ? $key : $default;
    }

    /**
     * @param int|string $id
     * @return ArticleInterface
     * @TODO implement
     */
    public function getById($id)
    {
        $data = $this->resource->load($id);
    }
}
