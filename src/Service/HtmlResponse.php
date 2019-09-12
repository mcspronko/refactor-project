<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Service;

use Psr\Http\Message\ResponseInterface;
use Twig\Environment;

/**
 * Class HtmlResponse
 */
class HtmlResponse
{
    /**
     * @var string
     */
    private $suffix = '.html.twig';

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var HtmlResponseFactory
     */
    private $responseFactory;

    /**
     * HtmlResponse constructor.
     * @param Environment $environment
     * @param HtmlResponseFactory $responseFactory
     */
    public function __construct(
        Environment $environment,
        HtmlResponseFactory $responseFactory
    ) {
        $this->twig = $environment;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param $template
     * @param $args
     * @return ResponseInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render($template, $args): ResponseInterface
    {
        return $this->responseFactory->create($this->twig->render($template . $this->suffix, $args));
    }
}
