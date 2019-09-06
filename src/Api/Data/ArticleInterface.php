<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Api\Data;

/**
 * Interface ArticleInterface
 * @api
 */
interface ArticleInterface
{
    /**
     * @param $id
     */
    public function setId($id): void;

    /**
     * @param $title
     */
    public function setTitle($title): void;

    /**
     * @param $content
     */
    public function setContent($content): void;

    /**
     * @param $date
     */
    public function setDate($date): void;

    /**
     * @param $slug
     */
    public function setSlug($slug): void;

    /**
     * @param $images
     */
    public function setImages($images): void;

    /**
     * @param $tags
     */
    public function setTags($tags): void;

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getTitle();

    /**
     * @return mixed
     */
    public function getContent();

    /**
     * @return mixed
     */
    public function getDate();

    /**
     * @return mixed
     */
    public function getSlug();

    /**
     * @return mixed
     */
    public function getImages();

    /**
     * @return mixed
     */
    public function getTags();
}
