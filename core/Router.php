<?php

namespace Core;

/**
 * The router class takes care of register the application routes and direct
 * the user's requests.
 *
 * Variant of App class from Laracast:
 * https://github.com/laracasts/The-PHP-Practitioner-Full-Source-Code/blob/master/core/Router.php
 */
class Router
{
    /**
     * Contains all registered routes.
     *
     * @var array
     */
    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Resource name and base url needed for appending the url prefix on the
     * resource urls group.
     *
     * @var string
     */
    protected $resourceName = null;
    protected $resourceBaseUrl =null;

    /**
     * Handle the page not found if set.
     * EG: HomeController@page404
     *
     * @var string
     */
    protected $page404 = null;



    /**
     * Register a GET route.
     *
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function get($uris, $controller)
    {
        if (! is_array($uris)) $uris = [$uris];

        foreach ($uris as $uri) {
            $this->appendRoute('GET', $uri, $controller);
        }
    }



    /**
     * Register a POST route.
     *
     * @param string $uri
     * @param string $controller
     * @return void
     */
    public function post($uris, $controller)
    {
        if (! is_array($uris)) $uris = [$uris];

        foreach ($uris as $uri) {
            $this->appendRoute('POST', $uri, $controller);
        }
    }



    /**
     * Set the controller to handle the 404 error.
     *
     * @param string $controller
     * @return void
     */
    public function page404($controller)
    {
        $this->page404 = "App\\Controllers\\{$controller}";
    }



    /**
     * Load the routes file from the given resource folder.
     *
     * @param string $baseUrl
     * @param string $resourceName
     * @return Router
     */
    public function resource($baseUrl, $resourceName)
    {
        $path = get_absolute_path("/app/resources/$resourceName/routes.php");

        if (empty($resourceName)) {
            throw new \Exception("The resourceName is not valid for the resource $baseUrl", 1);
        }

        if (! $path) {
            throw new \Exception("Routes file not found in the folder entity $resourceName: " . $path, 1);
        }

        $this->resourceBaseUrl = trim($baseUrl, '/') . '/';
        $this->resourceName = $resourceName;

        $router = &$this;
        require $path;

        $this->resourceBaseUrl = null;
        $this->resourceName = null;
    }



    /**
     * Load a user's routes file.
     *
     * @param string $file
     * @return Router
     */
    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }



    /**
     * Load the requested URI's associated controller method.
     *
     * @param boolean $return404|false
     * @return mixed
     */
    public function direct()
    {
        $requestType = $_SERVER['REQUEST_METHOD'];

        $uri = rtrim($this->requestUri(), '/');

        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        }

        // in case of route not found
        if ($this->page404) return $this->callAction(
            ...explode('@', $this->page404)
        );

        throw new \Exception('No route defined for this URI.');
    }



    /**
     * Clean and return the request uri.
     *
     * @return string
     */
    private function requestUri()
    {
    	$parsedUri = parse_url($_SERVER['REQUEST_URI']);

    	$basePath = str_replace('index.php', '', parse_url($_SERVER['SCRIPT_NAME']));

    	return str_replace($basePath, '', $parsedUri['path']);
    }



    /**
     * Load and call the relevant controller action.
     *
     * @param string $controller
     * @param string $action
     * @param mixed
     */
    private function callAction($controller, $action)
    {
        $controllerObj = new $controller;

        if (! method_exists($controllerObj, $action)) {
            throw new \Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $controllerObj->$action();
    }



    /**
     * Append the URL and relative controller to the routes list.
     *
     * @param string $method
     * @param string $url
     * @param string $controller
     * @return void
     */
    private function appendRoute($method, $url, $controller)
    {
        if ($this->resourceBaseUrl and $this->resourceName) {
            $url = $this->resourceBaseUrl . ltrim($url, '/');
            $controller = "App\\Resources\\{$this->resourceName}\\{$controller}";

            $this->routes[$method][$url] = $controller;
        }

        else $this->routes[$method][$url] = "App\\Controllers\\{$controller}";
    }
}
