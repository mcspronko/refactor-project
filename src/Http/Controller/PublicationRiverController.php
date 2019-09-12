<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Api\ArticleRepositoryInterface;
use JournalMedia\Sample\Service\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class PublicationRiverController
 */
class PublicationRiverController
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

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {

        $articles = $this->articleRepository->getList();

        return $this->response->render('index', ['articles' => $articles]);
    }
}
