<?php

namespace JournalMedia\Sample\Http\Controller;

use JournalMedia\Sample\Classes\DataHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class ArticleController extends DataHandler
{
    public function __invoke( ServerRequestInterface $request, ResponseInterface $response, array $args ): ResponseInterface
    {
        $this->setArticle($args['id']);

        $data = (getenv('DEMO_MODE') === "true") ? $this->fetchFile() : $this->fetchAPI();

        ob_start();

        include('../src/View/page.php');

        $view_content = ob_get_contents();

        ob_end_clean();

        return new HtmlResponse(
            $view_content
        );
    }
}
