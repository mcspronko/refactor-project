<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service\Http\Converter;

use JournalMedia\Sample\Api\ConverterInterface;
use JournalMedia\Sample\Api\Data\ArticleInterface;
use JournalMedia\Sample\Domain\Data\Response;
use JournalMedia\Sample\Service\ContainerProvider;
use JournalMedia\Sample\Service\Http\ConverterException;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class JsonToArray
 */
class JsonToArray implements ConverterInterface
{

    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * JsonToArray constructor.
     */
    public function __construct()
    {
        $this->container = ContainerProvider::getInstance();
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
                    /** @var ArticleInterface $article */
                    $article = $this->container->get('article');
                    $article->setId($this->getValue('id', $item));
                    $article->setTitle($this->getValue('title', $item));
                    $article->setDate($this->getValue('date', $item));
                    $article->setSlug($this->getValue('slug', $item));
                    $article->setContent($this->getValue('content', $item));
                    $article->setImages($this->getValue('images', $item));
                    $article->setTags($this->getValue('tags', $item));
                    $article->setExcerpt($this->getValue('excerpt', $item));

                    $items[$article->getId()] = $article;
                } catch (\Exception $exception) {
                    //@TODO log exception
                }
            }

            $pagination = isset($result['response']['pagination']) ? $result['response']['pagination'] : [];
            $response = new Response($items, $pagination);

            return $response;
        } else {
            throw new ConverterException('Couldn\'t convert the response.');
        }
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
