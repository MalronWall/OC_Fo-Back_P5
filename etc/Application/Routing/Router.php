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

class Router
{
    private $url;
    private $routes = [];
    private $namedRoutes = [];
    private $errorController;

    /**
     * Router constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->errorController = new ErrorController();
    }

    /**
     * @param $path
     * @param $callable
     * @param null $name
     * @return Route
     */
    public function get($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    /**
     * @param $path
     * @param $callable
     * @param null $name
     * @return Route
     */
    public function post($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    /**
     * @param $path
     * @param $callable
     * @param $name
     * @param $method
     * @return Route
     */
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

    /**
     * @return mixed|string
     */
    public function run()
    {
        try {
            if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
                throw new InternalServerErrorException();
            }

            /** @var Route $route */
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
                if ($this->match($this->url, $route)) {
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

    /**
     * @param $name
     * @param array $params
     * @return string
     */
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

    /**
     * @param $url
     * @param Route $route
     * @return bool
     */
    public function match($url, Route $route)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback(
            '#:([\w]+)#',
            function ($matches) use ($route) {
                if (isset($route->getParams()[$matches[1]])) {
                    return '('.$route->getParams()[$matches[1]].')';
                }
                return '([^/]+)';
            },
            $route->getPath()
        );
        $regex = "#^$path$#i";
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }
        array_shift($matches);
        $route->setMatches($matches);
        return true;
    }
}
