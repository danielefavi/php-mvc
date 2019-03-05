<?php

namespace App\Controllers;

use \Core\App;



class AdminController
{

    /**
     * Constructor: block the access to the AdminController if the user is
     * not logged in.
     *
     * @return void
     */
    public function __construct()
    {
        if (! auth()->isLogged()) {
            return redirect('/');
        }
    }



    /**
     * Show the administration view.
     *
     * @return void
     */
    public function home()
    {
        return view('admin/home');
    }

}
