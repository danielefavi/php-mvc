<?php

namespace App\Controllers;

use \Core\App;
use \Core\Request;



class HomeController
{

    /**
     * Show the welcome page if the user is not loggen in otherwise it will
     * redirect the user to the administration homepage.
     *
     * @return void
     */
    public function welcome()
    {
        if (! auth()->isLogged()) {
            return view('welcome');
        }

        return redirect('admin/home');
    }



    /**
     * A controller test function where you can do your tests :)
     *
     * @return void
     */
    public function test()
    {
        $r = new Request;

        dd( $r->get() );
    }



    /**
     * Perfom the logout and redirect the user back to the login page.
     *
     * @return void
     */
    public function logout()
    {
        auth()->logout();

        return redirect('login');
    }



    /**
     * Perform the login: if the user is already logged in then he will be
     * redirected to the administration homepage otherwise it will show the
     * login view.
     *
     * @return void
     */
    public function login()
    {
        if (auth()->isLogged()) {
            return redirect('admin/home');
        }

        return view('login');
    }



    /**
     * Performs the actual login when the user send the post request.
     *
     * @return void
     */
    public function performLogin()
    {
        $user = request()->post('user');
        $pass = request()->post('password');

        if (auth()->login($user, $pass)) {
            return redirect('admin/home');
        }

        return view('login', ['loginAttempt' => false]);
    }



    /**
     * It shows the 404 page.
     *
     * @param Class $parameter
     * @return void
     */
    public function page404()
    {
        return view('404');
    }
}
