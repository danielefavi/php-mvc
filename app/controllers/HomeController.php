<?php

namespace App\Controllers;

use \Core\App;



class HomeController
{
    public function welcome()
    {
        if (! auth()->isLogged()) {
            return view('welcome');
        }

        return redirect('admin/home');
    }



    public function home()
    {
        dd('aaa');
    }



    public function logout()
    {
        auth()->logout();

        return redirect('login');
    }



    public function login()
    {
        if (auth()->isLogged()) {
            return redirect('admin/home');
        }

        return view('login');
    }



    public function performLogin()
    {
        $user = request('post', 'user');
        $pass = request('post', 'password');

        if (auth()->login($user, $pass)) {
            return redirect('admin/home');
        }

        return view('login', ['loginAttempt' => false]);
    }



    public function page404()
    {
        return view('404');
    }
}
