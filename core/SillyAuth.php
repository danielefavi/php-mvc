<?php

namespace Core;


/**
 * This is a simple and NOT-sicure-at-all class to handle authentication
 * through password and cookies.
 * NOTE: This class is just for testing.
 */
class SillyAuth
{
    /**
     * Username for the login.
     *
     * @var string
     */
    private $user = 'ff33785_72_bcdA895Vb_dbbe4469bTG';

    /**
     * Password for the login.
     *
     * @var string
     */
    private $pass = 'L1_eZaabcd80fd_b804eX3bN5b452_Ob';

    /**
     * Name of the cookie where to store the user's session.
     *
     * @var string
     */
    private $cookieName = 'sillyauth_cookie';

    /**
     * Name of the session.
     *
     * @var string
     */
    private $sessionName = 'sillyauth_session';

    /**
     * Failed permitted attempts.
     *
     * @var numeric
     */
    private $attempts = 10;

    /**
     * Seconds that the user has to wait after $attempts number of  failed
     * attempts.
     *
     * @return numeric
     */
    private $waitSecs = 60;



    /**
     * Constructor: initialize the user's settings and sessions' settings.
     *
     * @param string $user
     * @param string $pass
     * @param string $cookieName
     * @param string $sessionName
     * @param numeric $attempts|10
     * @param numeric $waitSecs|60
     * @return void
     */
    public function __construct($user, $pass, $cookieName, $sessionName, $attempts=10, $waitSecs=60)
    {
        @session_start();

        $this->user = $user;
        $this->pass = $pass;
        $this->cookieName = $cookieName;
        $this->sessionName = $sessionName;
        $this->attempts = $attempts;
        $this->waitSecs = $waitSecs;
    }



    /**
     * Check if the current user is logged in cheching his session and cookies.
     *
     * @return boolean
     */
    public function isLogged()
    {
        if ($this->sessionIsValid()) return true;

        return $this->login();
    }



    /**
     * This to perform the login: if the username and password are not given
     * than the function will attempt to login using cookies.
     *
     * @param string $user|null
     * @param string $pass|null
     * @return boolean
     */
    public function login($user=null, $pass=null)
    {
        if (! $this->loginAttempt()) return false;

        if (!$user and !$pass) {
            return $this->loginWithCookies();
        }

        return $this->loginWithCredentials($user, $pass, false);
    }



    /**
     * Check if the given credentials are correct.
     *
     * @param string $user
     * @param string $pass
     * @return boolean
     */
    public function correctCredentials($user, $pass, $loginAttempt=true)
    {
        if ($loginAttempt) {
            if (! $this->loginAttempt()) return false;
        }

        $res = (($user == $this->user) and ($pass == $this->pass));

        if ($res) $this->resetLoginAttemptsSession();

        return $res;
    }



    /**
     * Perform the logout: it delete the session and cookies.
     *
     * @return void
     */
    public function logout()
    {
        @session_start();

        unset($_SESSION[$this->sessionName]);

        setcookie($this->cookieName, 0, 0, "/");
    }



    /**
     * Keep track of the user's login attempt: if the attemtps are more than $this->attemtps
     * then the user has to wait 10 minutes to try again.
     *
     * @return boolean
     */
    private function loginAttempt()
    {
        @session_start();

        if (! isset($_SESSION['sillyauth_login_attempt'])) $_SESSION['sillyauth_login_attempt'] = 0;
        $attempts = ++$_SESSION['sillyauth_login_attempt'];

        if ($attempts > $this->attempts) {
            if (empty($_SESSION['sillyauth_login_timeout'])) $_SESSION['sillyauth_login_timeout'] = time();
            $time = $_SESSION['sillyauth_login_timeout'];

            // checking if the waiting time passed
            if ((time() - $time) > $this->waitSecs) {
                // if waiting time passed then it resets the session variables
                $this->resetLoginAttemptsSession();
            }
            else sleep(5);

            return false;
        }

        return true;
    }



    /**
     * Reset the session variables concerning the login attempts.
     *
     * @return void
     */
    private function resetLoginAttemptsSession()
    {
        $_SESSION['sillyauth_login_attempt'] = 0;
        $_SESSION['sillyauth_login_timeout'] = null;
    }



    /**
     * Check if the value in the user session is valid.
     *
     * @return boolean
     */
    private function sessionIsValid()
    {
        return (
            isset($_SESSION[$this->sessionName]) and
            ($_SESSION[$this->sessionName] == $this->getSessionVal())
        );
    }



    /**
     * Perform the login using the cookie: if the value of the user's cookie
     * is equal to the user+pass encripted it will start the session.
     *
     * @return boolean
     */
    private function loginWithCookies()
    {
        if (isset($_COOKIE) and isset($_COOKIE[$this->cookieName]) and $_COOKIE[$this->cookieName]) {
            if ($_COOKIE[$this->cookieName] == $this->getSessionVal()) {
                $this->startUserSession();
                $this->resetLoginAttemptsSession();

                return true;
            }
        }

        setcookie($this->cookieName, 0, 0, "/");

        return false;
    }



    /**
     * Perform the login using the given username and password.
     *
     * @param string $user
     * @param string $pass
     * @return void
     */
    private function loginWithCredentials($user, $pass, $loginAttempt=true)
    {
        if ($this->correctCredentials($user, $pass, $loginAttempt)) {
            $this->startUserSession();

            return true;
        }

        return false;
    }



    /**
     * Start the user session and set the cookies.
     *
     * @return void
     */
    private function startUserSession()
    {
        $val = $this->getSessionVal();

        $_SESSION[$this->sessionName] = $val;

        $time = (int)(time() + (86400 * 30 * 250));
        if ($time < 0) $time = $time * -1;

        setcookie($this->cookieName, $val, $time, "/");
    }



    /**
     * Return the content of the user's session that will go to the cookies and
     * session.
     *
     * @return string
     */
    private function getSessionVal()
    {
        return md5($this->user) . md5($this->pass);
    }
}
