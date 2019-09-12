<?php

declare(strict_types=1);

namespace JournalMedia\Sample\Http;

use Twig\Environment;
use Zend\Diactoros\Response\HtmlResponse as ZendHtmlResponse;

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
     * HtmlResponse constructor.
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $this->twig = $environment;
    }

    /**
     * @param $template
     * @param $args
     * @return ZendHtmlResponse
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render($template, $args): ZendHtmlResponse
    {
        return new ZendHtmlResponse($this->twig->render($template . $this->suffix, $args));
    }
}
