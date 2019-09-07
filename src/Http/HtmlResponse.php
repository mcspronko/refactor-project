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
     * @param $template
     * @param $args
     * @return ZendHtmlResponse
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render($template, $args): ZendHtmlResponse
    {
        /** @var Environment $twig */
        $twig = ServiceProvider::getInstance()->get(Environment::class);

        return new ZendHtmlResponse($twig->render($template . $this->suffix, $args));
    }
}