<?php

use Core\App;



/**
 * Return the full path. EG: /var/www/html/the-app-folder/base-url/$path
 *
 * @param string $path|null
 * @return string
 */
function get_absolute_path($path=null)
{
    $absPath = rtrim(__DIR__ , '/core');

    if ($path) {
        $absPath = rtrim($absPath, '/');
        $absPath = rtrim($absPath, '\\'); // winzoz

        $absPath .= '/' . ltrim($path, '/');
    }

    return $absPath;
}



/**
 * Return the full URL. EG: http://localhost/the-app-folder/base-url/$path
 *
 * @param string $path|null
 * @param array $params|[]
 * @return string
 */
function get_uri($path=null, $params=[])
{
    if ($path && substr(strtolower($path), 0, 4) == 'http') {
        return $path;
    }

    $uri = get_uri_prefix();

    $uri .= get_rel_path($path);

    return append_params_to_uri($uri, $params);
}



/**
 * Return the base url;
 *
 * @return string
 */
function get_uri_prefix()
{
    $uri = $_SERVER['REQUEST_SCHEME'] . '://';
    $uri .= $_SERVER['HTTP_HOST'];

    return $uri;
}



/**
 * Return the current url appending the given parameters.
 *
 * @param array $params|[]
 * @return string
 */
function get_current_uri($params=[])
{
    $uri = $_SERVER['REQUEST_URI'];

    $uri = get_uri_prefix() . $uri;

    return append_params_to_uri($uri, $params);
}



/**
 * Return the relative path folder of the current app.
 *
 * @return string
 */
function get_current_base_uri()
{
    if (! empty($_SERVER['SCRIPT_NAME'])) {
        $baseUri = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    }
    else if (! empty($_SERVER['PHP_SELF'])) {
        $baseUri = str_replace('index.php', '', $_SERVER['PHP_SELF']);
    }

    return trim($baseUri, '/');
}


/**
 * Return the relative path of the app. This function mix the base path with the
 * given relative path.
 *
 * @param string $path|null
 * @return string
 */
function get_rel_path($path=null)
{
    $base = get_rel_base_path();

    if ($path) {
        $path = ltrim($path, '/');

        return $base . '/' . $path;
    }

    return $base;
}



/**
 * Return the base relative application path of the application.
 *
 * @return string
 */
function get_rel_base_path()
{
    $path = '/';

    $path .= trim(App::get('base_url'), '/');

    return $path;
}



/**
 * Return the relative path of the public upload folder.
 *
 * @param string $path|null
 * @return string
 */
function get_rel_storage_path($path=null)
{
    $pubPath = '/' . trim(App::get('storage_path'), '/');

    if ($path) return $pubPath . '/' . ltrim($path, '/');

    return $pubPath;
}



/**
 * Return the absolute path of the public upload folder.
 *
 * @param string $path|null
 * @return string
 */
function get_storage_path($path=null)
{
    return get_absolute_path(get_rel_storage_path($path));
}



/**
 * Append to the given URL the given parameters.
 * If the URL and the $params array share an equal key the key in the $params
 * will be taken.
 *
 * @param string $uri
 * @param array $params|[]
 * @return string
 */
function  append_params_to_uri($uri, $params=[])
{
    if (count($params)) {
        foreach (request('get', []) as $key => $value) {
            if (! isset($params[$key])) {
                $params[$key] = $value;
            }
        }

        $uri = explode('?', $uri)[0] . '?';

        foreach ($params as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $arrVal) {
                    $uri .= $key . "[]=$arrVal&";
                }
            } else {
                $value = urlencode($value);

                $uri .= "$key=$value&";
            }
        }

        $uri = rtrim($uri, '&');
    }

    return $uri;
}



/**
 * Set a variable in session.
 *
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function set_session($key, $value=null)
{
    @session_start();

    $_SESSION[$key] = $value;
}



/**
 * Return a variable from session.
 *
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function get_session($key, $default=null)
{
    @session_start();

    if (isset($_SESSION[$key])) return $_SESSION[$key];

    return $default;
}



/**
 * Unset a session variable.
 *
 * @param string $key
 * @return void
 */
function unset_session($key)
{
    @session_start();

    if (isset($_SESSION[$key])) unset($_SESSION[$key]);
}



/**
 * Write the given message in to the log file.
 *
 * @param string $message
 * @return boolean
 */
function add_log($message)
{
    if (!$path = get_log_file_path()) return false;

    if (!is_string($message) and !is_numeric($message)) {
        $message = json_encode($message);
    }

    $message = date('Y-m-d H:i:s') . ' - ' . $message . "\n";

    file_put_contents($path, $message, FILE_APPEND | LOCK_EX);

    return true;
}



/**
 * Return the absolute path of the log file.
 *
 * @return string
 */
function get_log_file_path()
{
    if (! App::has('log_file_path')) return false;

    return get_absolute_path( App::get('log_file_path') );
}



/**
 * Return the SillyAuth authentication.
 *
 * @return SillyAuth
 */
function auth()
{
    if (App::has('auth')) {
        return App::get('auth');
    }

    return null;
}



/**
 * Return the DB connection.
 *
 * @return DBConnection
 */
function DB()
{
    if (App::has('db')) {
        return App::get('db');
    }

    return null;
}



/**
 * Redirect to a new page.
 *
 * @param  string $path
 * @param  array $params|[]
 * @return void
 */
function redirect($path, $params=[])
{
    if (substr(strtolower($path), 0, 4) != 'http') {
        $path = get_rel_path($path);
    }

    if (count($params)) {
        $path = append_params_to_uri($path, $params);
    }

    header("Location: " . $path);

	exit;
}



/**
 * Redirect to a new page.
 *
 * @param  string $path
 * @return void
 */
function redirectBack()
{
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        exit;
    }

	return redirect('/');
}



/**
 * Check if the given path matchs with the user's URL.
 *
 * @param mixed $paths          Path or list of paths to check
 * @param string $retVal|true   The default value that returns if the given path match
 * @return mixed
 */
function link_is_active($paths, $retVal=true)
{
    if (is_string($paths)) $paths = [ $paths ];

    foreach ($paths as $path) {
        if (substr($path, -1) == '*') {
            $path = get_uri( rtrim($path, '*') );

            if (strpos(get_current_uri(), $path) === 0) return $retVal;
        }
        else {
            $path = trim(get_uri($path), '/');

            if (trim(get_current_uri(), '/') == $path) return $retVal;
        }
    }

    return false;
}



/**
 * Get the data from the request.
 *
 * @param string $type
 * @param string $var|null
 * @return mixed
 */
function request($type, $var=null, $default=null)
{
	$type = strtoupper($type);

	if ($type == 'GET') {
		if (! $var) return $_GET;
		else if (isset($_GET[$var])) return $_GET[$var];
	}

	else if ($type == 'POST') {
		if (! $var) return $_POST;
		else if (isset($_POST[$var])) return $_POST[$var];
	}

    else if ($type == 'ALL') {
        $all = array_merge($_GET, $_POST);

		if (! $var) return $all;
		else if (isset($all[$var])) return $all[$var];
	}

    else if ($type == 'FILES') {
        if (! $var) return $_FILES;
		else if (isset($_FILES[$var])) return $_FILES[$var];
	}

	return $default;
}



/**
 * Require a given view.
 *
 * @param string $name
 * @param array $data|[]
 * @return void
 */
function view($name, $data=[])
{
	extract($data);

	return require get_absolute_path("app/views/{$name}.view.php");
}



/**
 * This function is used to make the notices and warnings blocking exception
 * in case of debug mode.
 *
 * @param string $errNo
 * @param string $errStr
 * @param string $errFile
 * @param numeric $errLine
 * @return void
 */
function error_notice_warning_handle($errNo, $errStr, $errFile, $errLine)
{
    $msg = "$errStr in $errFile on line $errLine";

    if ($errNo == E_NOTICE || $errNo == E_WARNING) {
        if ($errNo == E_NOTICE) $msg = ' -- NOTICE -- ' . $msg;
        else $msg = ' -- WARNING -- ' . $msg;

        throw new \Exception($msg, $errNo);
    }
    else {
        echo $msg;
    }
}



/**
 * Die and Dump.
 *
 * @param mixed $val|null
 * @param boolean $stop|true
 * @return void
 */
function dd($val=null, $stop=true)
{
    $html = print_r($val, true);
    $html = htmlspecialchars($html, ENT_COMPAT, 'UTF-8');

    echo '<pre style="padding:20px; color:#FFF; background-color:#000;">';
    echo $html;
    echo '</pre>';

    if ($stop) die();
}
