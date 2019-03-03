<?php

namespace App\Controllers;

use \Core\App;



class AdminController
{
    public function __construct()
    {
        if (! auth()->isLogged()) {
            return redirect('/');
        }
    }



    public function home()
    {
        return view('admin/home');
    }

}
