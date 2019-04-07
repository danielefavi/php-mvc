<?php

namespace Core;



class Request
{
    /**
     * Contain the parameter in the url.
     * EG: if in the route you have /projects/{projectId}/edit/{taskId} and the request
     * is /projects/12/edit/3 then the $routes should contains
     * [ 'projectId' => 12 , 'taskId' => 3 ]
     *
     * @var array
     */
    protected $routes = [];



    /**
     * Set the route parameters.
     *
     * @param array $routes
     * @return array
     */
    public function setRouteAttributes($routes)
    {
        return $this->routes = $routes;
    }



    /**
     * Get the route parameters.
     *
     * @param array $routes
     * @return array
     */
    public function routes($var=null)
    {
        if ($var) return $this->routes[$var] ?? null;

        return $this->routes;
    }



    /**
     * Return the values from the get request.
     *
     * @param string $var|null
     * @param mixed $default|null
     * @return mixed
     */
    public function get($var=null, $default=null)
    {
        if ($var) return $_GET[$var] ?? $default;

        return $_GET;
    }



    /**
     * Return the values from the post request.
     *
     * @param string $var|null
     * @param mixed $default|null
     * @return mixed
     */
    public function post($var=null, $default=null)
    {
        if ($var) return $_POST[$var] ?? $default;

        return $_POST;
    }



    /**
     * Return the values from both $_GET and $_POST request.
     *
     * @param string $var|null
     * @param mixed $default|null
     * @return mixed
     */
    public function all($var=null, $default=null)
    {
        $all = array_merge($_GET, $_POST);

        if ($var) return $all[$var] ?? $default;

        return $all;
    }



    /**
     * Return the files from the request.
     *
     * @param string $var|null
     * @return mixed
     */
    public function file($var=null)
    {
        if ($var) return $_FILE[$var] ?? null;

        return $_FILE;
    }

}
