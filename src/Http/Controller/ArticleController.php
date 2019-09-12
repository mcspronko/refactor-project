<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Api\ArticleRepositoryInterface;
use JournalMedia\Sample\Http\HtmlResponse;
use JournalMedia\Sample\Service\ContainerProvider;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class ArticleController
 */
class ArticleController
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        /** @var ArticleRepositoryInterface $articleRepository */
        $articleRepository = ContainerProvider::getInstance()->get('article.repository');
        $article = $articleRepository->getById($args['id']);

        $response = new HtmlResponse();
        return $response->render('article', ['article' => $article]);
    }
}
