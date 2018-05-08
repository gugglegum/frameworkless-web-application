<?php

namespace app\web\controllers;

use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class MainController extends AbstractController
{
    public function action(ServerRequest $request)
    {
        $urlGenerator = $this->resourceManager->getWebRouter()->getGenerator();
        $response = new Response\HtmlResponse(
            "<h1>Main page</h1>\n"
                . "<ul>\n"
                . "<li><a href=\"" . htmlspecialchars($urlGenerator->generate('hello', ['name' => 'world'])) . "\">Hello, %username%</li>"
                . "<li><a href=\"" . htmlspecialchars($urlGenerator->generate('foo')) . "\">Foo</a></li>"
                . "<li><a href=\"" . htmlspecialchars($urlGenerator->generate('bar')) . "\">Bar</a></li>"
                . "</ul>\n"
        );
        return $response;
    }

}
