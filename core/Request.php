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
        if ($var) {
            if (isset($_POST[$var])) return $_POST[$var];

            return $_GET[$var] ?? $default;
        }

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



    /**
     * Validate a request.
     *
     * @param array $rules
     * @return array
     */
    public function validate($rules)
    {
        $data = [];
        $errorMessages = [];

        foreach($rules as $key => $rule) {
            $value = $this->get($key);
            $errors = $this->performValidation($key, $value, $rule);

            if (count($errors)) {
                $errorMessages[$key] = $errors;
            } else {
                $data[$key] = $value;
            }
        }

        return [
            'data' => $data,
            'errors' => $errorMessages,
        ];
    }



    /**
     * Perform the actual validation on the given value.
     *
     * @param string $key
     * @param mixed $value
     * @param mixed $rule
     * @return array
     */
    protected function performValidation($key, $value, $rule)
    {
        $errors = [];
        if (!is_array($rule)) $rule = explode('|', $rule);

        if (in_array('trim', $rule)) $value = trim($value);

        if (in_array('required', $rule)) {
            if (empty($value)) $errors[] = "$key is required.";
        }

        if (in_array('string', $rule)) {
            if (! is_string($value)) $errors[] = "$key is not a string.";
        }

        if (in_array('numeric', $rule)) {
            if (! is_numeric($value)) $errors[] = "$key is not a number.";
        }

        return $errors;
    }

}
