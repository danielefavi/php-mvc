<?php


namespace App\Resources\Posts;

use \Core\App;



class Controller
{
    /**
     * The constructor protects the controller from not logged user.
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
     * Shows the post main page.
     *
     * @return void
     */
    public function index()
    {
        // getting all the posts already paginated
        $res = Post::paginate();

        return view('posts/index', [
            'posts' => $res['result'],
            'pagination' => $res['pagination']
        ]);
    }



    /**
     * Shows the post creation form.
     *
     * @return void
     */
    public function create()
    {
        return view('posts/create');
    }



    /**
     * Store a new post when the user submit the button.
     *
     * @return void
     */
    public function store()
    {
        $errors = $this->validateForm();

        if (count($errors)) {
            return view('posts/create', compact('errors'));
        }

        $post = Post::create(request('post'));

        return redirect('admin/posts/edit', ['id' => $post->data->id]);
    }



    /**
     * Show the edit form.
     *
     * @return void
     */
    public function edit()
    {
        if ($post = Post::find(request('get', 'id'))) {
            return view('posts/edit', compact('post'));
        }

        // return the 404 page if the post is not found
        return view('404');
    }



    /**
     * Depending on the button the user presses it performs a differen action.
     *
     * @return void
     */
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



    /**
     * First perfomrs the form validation on the post then update it.
     *
     * @param Post $post
     * @return void
     */
    private function update($post)
    {
        $errors = $this->validateForm();

        if (! count($errors)) {
            $post->save(request('post'));
        }

        return view('posts/edit', compact('post', 'errors'));
    }



    /**
     * Delete the given post and redirect to the post main page.
     *
     * @param Post $post
     * @return void
     */
    public function delete($post)
    {
        $post->delete();

        return redirect('admin/posts/index');
    }



    /**
     * Perform the form validation checking the data from the request.
     *
     * @return array
     */
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
