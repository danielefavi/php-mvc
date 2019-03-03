<?php

namespace App\Controllers;

use App\Models\Post;
use \Core\App;



class PostController
{
    public function __construct()
    {
        if (! auth()->isLogged()) {
            return redirect('/');
        }
    }



    public function index()
    {
        $res = Post::paginate();

        return view('posts/index', [
            'posts' => $res['result'],
            'pagination' => $res['pagination']
        ]);
    }



    public function create()
    {

    }



    public function store()
    {

    }



    public function edit()
    {

    }



    public function update()
    {

    }



    public function delete()
    {

    }
}
