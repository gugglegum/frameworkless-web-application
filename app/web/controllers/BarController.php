<?php

namespace app\web\controllers;

use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class BarController extends AbstractController
{
    public function action(ServerRequest $request)
    {
        $response = new Response\HtmlResponse(
            "<h1>Bar!</h1>"
        );
        return $response;
    }

}
