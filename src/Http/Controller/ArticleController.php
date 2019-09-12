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
    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * @var HtmlResponse
     */
    private $response;

    /**
     * ArticleController constructor.
     * @param ArticleRepositoryInterface $articleRepository
     * @param HtmlResponse $response
     */
    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        HtmlResponse $response
    ) {
        $this->articleRepository = $articleRepository;
        $this->response = $response;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {

        $article = $this->articleRepository->getById((int) $args['id']);

        return $this->response->render('article', ['article' => $article]);
    }
}
