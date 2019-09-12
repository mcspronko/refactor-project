<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Api\ArticleRepositoryInterface;
use JournalMedia\Sample\Http\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class TagRiverController
 */
class TagRiverController
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
        $tag = $args['tag'];

        $articles = $this->articleRepository->getListByTag($tag);

        return $this->response->render('index', [
            'articles' => $articles,
            'tag' => $tag
        ]);
    }
}
