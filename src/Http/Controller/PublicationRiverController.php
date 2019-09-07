<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Api\ArticleRepositoryInterface;
use JournalMedia\Sample\Http\HtmlResponse;
use JournalMedia\Sample\Service\ContainerProvider;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class PublicationRiverController
 */
class PublicationRiverController
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args ): ResponseInterface
    {
        /** @var ArticleRepositoryInterface $articleRepository */
    	$articleRepository = ContainerProvider::getInstance()->get('article.repository');
        $articles = $articleRepository->getList();

        $response = new HtmlResponse();
        return $response->render('index', ['articles' => $articles]);
    }
}
