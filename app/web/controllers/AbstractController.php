<?php

namespace app\web\controllers;

use app\ResourceManager;

abstract class AbstractController
{
    /**
     * @var ResourceManager
     */
    protected $resourceManager;

    public function __construct(ResourceManager $resourceManager)
    {
        $this->resourceManager = $resourceManager;
    }
}
