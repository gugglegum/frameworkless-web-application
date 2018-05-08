<?php

namespace app\web\controllers;

use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class HelloController extends AbstractController
{
    public function action(ServerRequest $request)
    {
        $name = $request->getAttribute('name');
        $response = new Response\HtmlResponse(
            "<h1>Hello {$name}</h1>"
        );
        return $response;
    }
}
