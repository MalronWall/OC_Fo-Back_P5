<?php
/**
 * Created by PhpStorm.
 * User: TOURTE Thibaut
 * Date: 02/04/2018
 * Time: 22:14
 */
namespace Core\Application\Routing;

use Blog\Controller\ErrorController;
use Core\Application\Exception\NotFoundHttpException;
use Core\Application\Exception\RouterException;

class Router
{
    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct($url)
    {
        $this->url = $url;
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
                throw new RouterException('REQUEST_METHOD does not exist !');
            }

            /** @var Route $route */
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
                if ($route->match($this->url)) {
                    return $route->call();
                }
            }
            throw new NotFoundHttpException('No matching routes !');
        } catch (RouterException $e) {
            die("An error has occurred in Router.php->run: " . $e->getMessage());
        } catch (NotFoundHttpException $e) {
            $error = new ErrorController();
            return $error->notFound();
        }
    }

    public function url($name, $params = [])
    {
        try {
            if (!isset($this->namedRoutes[$name])) {
                throw new RouterException('No route matches this name !');
            }
            return $this->namedRoutes[$name]->getUrl($params);
        } catch (RouterException $e) {
            die("An error has occurred in Router.php->url(): " . $e->getMessage());
        }
    }
}
