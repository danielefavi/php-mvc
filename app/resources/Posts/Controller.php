<?php


namespace App\Resources\Posts;

use \Core\App;



class Controller
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
        return view('posts/create');
    }



    public function store()
    {
        $errors = $this->validateForm();

        if (count($errors)) {
            return view('posts/create', compact('errors'));
        }

        $post = Post::create(request('post'));

        return redirect('admin/posts/edit', ['id' => $post->data->id]);
    }



    public function edit()
    {
        if ($post = Post::find(request('get', 'id'))) {
            return view('posts/edit', compact('post'));
        }

        return view('404');
    }



    public function postActions()
    {
        if (!$post = Post::find(request('get', 'id'))) {
            return view('404');
        }

        if (request('post', 'action') == 'delete') {
            return $this->delete($post);
        }

        return $this->update($post);
    }



    private function update($post)
    {
        $errors = $this->validateForm();

        if (! count($errors)) {
            $post->save(request('post'));
        }

        return view('posts/edit', compact('post', 'errors'));
    }



    public function delete($post)
    {
        $post->delete();

        return redirect('admin/posts/index');
    }



    private function validateForm()
    {
        $errors = [];

        $title = request('post', 'title');

        if (!$title or !strlen($title)) {
            $errors[] = 'The title is mandatory.';
        }

        return $errors;
    }
}
