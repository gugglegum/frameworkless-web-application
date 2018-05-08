<?php

namespace app;

class ResourceManager
{
    /**
     * @var \Luracast\Config\Config
     */
    private $config;

    /**
     * @var \Aura\Router\RouterContainer
     */
    private $router;

    /**
     * @var \PDO
     */
    private $db;

    /**
     * @return \Luracast\Config\Config
     */
    public function getConfig(): \Luracast\Config\Config
    {
        if ($this->config === null) {
            $dotenv = new \Dotenv\Dotenv(__DIR__ . '/..');
            $dotenv->overload();
            $dotenv->required('DB_HOST')->notEmpty();
            $this->config = \Luracast\Config\Config::init(__DIR__ . '/../config');
        }
        return $this->config;
    }

    /**
     * @return \Aura\Router\RouterContainer
     */
    public function getWebRouter(): \Aura\Router\RouterContainer
    {
        if ($this->router === null) {
            $this->router =new \Aura\Router\RouterContainer();
            $map = $this->router->getMap();
            $map->get('main', '/', web\controllers\MainController::class . '::' . 'action');
            $map->get('hello', '/hello/{name}', web\controllers\HelloController::class . '::' . 'action');
            $map->get('foo', '/foo', web\controllers\FooController::class . '::' . 'action');
            $map->get('bar', '/bar', web\controllers\BarController::class . '::' . 'action');
        }
        return $this->router;
    }

    /**
     * @return \mindplay\middleman\Dispatcher
     */
    public function getDispatcher(): \mindplay\middleman\Dispatcher
    {
        $dispatcher = new \mindplay\middleman\Dispatcher([
            new \Middlewares\AuraRouter($this->getWebRouter()),
            new \Middlewares\RequestHandler(new \Middlewares\Utils\RequestHandlerContainer([$this])),
        ]);
        return $dispatcher;
    }

    /**
     * @param bool $newInstance
     * @return \PDO
     */
    public function getDb(bool $newInstance = false): \PDO
    {
        if ($this->db === null || $newInstance) {
            $db = new \PDO('');
            if ($this->db === null) {
                $this->db = $db;
            }
            return $db;
        }
        return $this->db;

//        $dbConfig = $this->getConfig()->get('database.connections.mysql');
    }
}
