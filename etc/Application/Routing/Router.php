<?php
/**
 * Created by PhpStorm.
 * User: TOURTE Thibaut
 * Date: 02/04/2018
 * Time: 22:14
 */
namespace Core\Application\Routing;

use Blog\Controller\ErrorController;
use Core\Application\Exception\InternalServerErrorException;
use Core\Application\Exception\NotFoundHttpException;
use Core\Application\Exception\RouterException;

class Router
{
    private $url;
    private $routes = [];
    private $namedRoutes = [];
    private $errorController;

    public function __construct($url)
    {
        $this->url = $url;
        $this->errorController = new ErrorController();
    }

    public function get($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    public function add($path, $callable, $name, $method)
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if (is_string($callable) && $name === null) {
            $name = $callable;
        }
        if ($name) {
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function run()
    {
        try {
            if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
                throw new InternalServerErrorException();
            }

            /** @var Route $route */
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
                if ($route->match($this->url)) {
                    return $route->call();
                }
            }
            throw new NotFoundHttpException('No matching routes !');
        } catch (InternalServerErrorException $e) {
            return $this->errorController->internalError(
                "An error has occurred in Router.php->run() : " . $e->getMessage()
            );
        } catch (NotFoundHttpException $e) {
            return $this->errorController->notFound();
        }
    }

    public function url($name, $params = [])
    {
        try {
            if (!isset($this->namedRoutes[$name])) {
                throw new InternalServerErrorException();
            }
            return $this->namedRoutes[$name]->getUrl($params);
        } catch (InternalServerErrorException $e) {
            return $this->errorController->internalError(
                "An error has occurred in Router.php->url() : " . $e->getMessage()
            );
        }
    }
}
