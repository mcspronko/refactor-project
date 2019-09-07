<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Domain\Data;

use JournalMedia\Sample\Api\Data\ArticleInterface;

/**
 * Class Article
 */
class Article implements ArticleInterface
{
    private $id;
    private $title;
    private $content;
    private $date;
    private $slug;
    private $images;
    private $tags;
    private $excerpt;

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function setImages($images): void
    {
        $this->images = $images;
    }

    public function setTags($tags): void
    {
        $this->tags = $tags;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setExcerpt($excerpt): void
    {
        $this->excerpt = $excerpt;
    }

    public function getExcerpt()
    {
        return $this->excerpt;
    }
}
