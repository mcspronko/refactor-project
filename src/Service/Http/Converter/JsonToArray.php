<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service\Http\Converter;

use JournalMedia\Sample\Api\ConverterInterface;
use JournalMedia\Sample\Api\Data\ArticleInterface;
use JournalMedia\Sample\Domain\Data\ArticleFactory;
use JournalMedia\Sample\Domain\Data\Response;
use JournalMedia\Sample\Service\Http\ConverterException;
use JournalMedia\Sample\Service\Http\ResponseFactory;

/**
 * Class JsonToArray
 */
class JsonToArray implements ConverterInterface
{
    /**
     * @var ArticleFactory
     */
    private $articleFactory;

    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * JsonToArray constructor.
     * @param ResponseFactory $responseFactory
     * @param ArticleFactory $articleFactory
     */
    public function __construct(
        ResponseFactory $responseFactory,
        ArticleFactory $articleFactory
    ) {
        $this->articleFactory = $articleFactory;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param array|string $data
     * @return array|Response|string
     * @throws ConverterException
     */
    public function convert($data)
    {
        $result = json_decode($data, true);

        if (isset($result['response'])) {
            $articles = [];
            if (isset($result['response']['articles'])) {
                $articles = $result['response']['articles'];
            } elseif (isset($result['response']['page_items'])) {
                $articles = $result['response']['page_items'];
            }

            $items = [];
            foreach ($articles as $item) {
                try {
                    $article = $this->createArticle($item);
                    $items[$article->getId()] = $article;
                } catch (\Exception $exception) {
                    //@TODO log exception
                }
            }

            $pagination = $this->createPagination($result);

            return $this->responseFactory->create($items, $pagination);
        } else {
            throw new ConverterException('Couldn\'t convert the response.');
        }
    }

    /**
     * @param array $item
     * @return ArticleInterface
     */
    private function createArticle(array &$item): ArticleInterface
    {
        $article = $this->articleFactory->create();
        $article->setId($this->getValue('id', $item));
        $article->setTitle($this->getValue('title', $item));
        $article->setDate($this->getValue('date', $item));
        $article->setSlug($this->getValue('slug', $item));
        $article->setContent($this->getValue('content', $item));
        $article->setImages($this->getValue('images', $item));
        $article->setTags($this->getValue('tags', $item));
        $article->setExcerpt($this->getValue('excerpt', $item));

        return $article;
    }

    /**
     * @param array $result
     * @return array
     */
    private function createPagination(array &$result): array
    {
        return isset($result['response']['pagination']) ? $result['response']['pagination'] : [];
    }

    /**
     * @param string $key
     * @param array $array
     * @param string $default
     * @return string
     */
    private function getValue($key, &$array, $default = '')
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }
}
