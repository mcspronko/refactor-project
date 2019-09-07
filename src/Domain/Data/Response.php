<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Domain\Data;

use JournalMedia\Sample\Api\Data\ArticleInterface;
use JournalMedia\Sample\Api\ResponseInterface;

/**
 * Class Response
 */
class Response implements ResponseInterface
{
    /**
     * @var array
     */
    private $articles;

    /**
     * @var array
     */
    private $pagination;

    /**
     * Response constructor.
     * @param $articles
     * @param $pagination
     */
    public function __construct($articles, $pagination)
    {
        $this->articles = $articles;
        $this->pagination = $pagination;
    }

    /**
     * @return ArticleInterface[]
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @return array
     */
    public function getPagination()
    {
        return $this->pagination;
    }
}
