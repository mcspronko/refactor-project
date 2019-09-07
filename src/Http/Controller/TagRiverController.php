<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Api\ArticleRepositoryInterface;
use JournalMedia\Sample\Http\HtmlResponse;
use JournalMedia\Sample\Service\ContainerProvider;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class TagRiverController
 */
class TagRiverController
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args ): ResponseInterface
    {
        $tag = $args['tag'];
        /** @var ArticleRepositoryInterface $articleRepository */
        $articleRepository = ContainerProvider::getInstance()->get('article.repository');
        $articles = $articleRepository->getListByTag($tag);

        $response = new HtmlResponse();
        return $response->render('index', [
            'articles' => $articles,
            'tag' => $tag
        ]);
    }
}
