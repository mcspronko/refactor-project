<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Test\Integration\Domain;

use JournalMedia\Sample\Domain\ArticleRepository;
use JournalMedia\Sample\Service\ContainerProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ArticleRepositoryTest extends TestCase
{
    /**
     * @var ArticleRepository
     */
    private $object;

    /**
     * @var ContainerBuilder
     */
    private $container;

    protected function setUp(): void
    {
        $this->container = ContainerProvider::getInstance();

        $this->object = $this->container->get('article.repository');
    }

    public function testGetList()
    {
        $result = $this->object->getList();

        $this->assertNotEmpty($result);
        $article = reset($result);

        $this->assertNotEmpty($article->getId());
        $this->assertNotEmpty($article->getTitle());
        $this->assertNotEmpty($article->getContent());
        $this->assertNotEmpty($article->getDate());
        $this->assertNotEmpty($article->getSlug());
        $this->assertNotEmpty($article->getTags());
        $this->assertNotEmpty($article->getImages());
    }
}
