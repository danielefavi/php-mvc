<?php


namespace App\Resources\Posts;

use \Core\App;
use \Core\Request;



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
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $validation = $this->validateForm($request);

        if (count($validation['errors'])) {
            return view('posts/create', [
                'errors' => $validation['errors']
            ]);
        }

        $post = Post::create($validation['data']);

        return redirect("admin/posts/{$post->data->id}/edit");
    }



    /**
     * Show the edit form.
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {
        if ($post = Post::find($request->routes('postId'))) {
            return view('posts/edit', compact('post'));
        }

        // return the 404 page if the post is not found
        return view('404');
    }



    /**
     * First perfomrs the form validation on the post then update it.
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        if (!$post = Post::find($request->routes('postId'))) return view('404');

        $validation = $this->validateForm($request);

        if (count($validation['errors'])) {
            return view('posts/create', [
                'errors' => $validation['errors']
            ]);
        }

        if (! count($validation['errors'])) {
            $post->save($request->post());
        }

        return view('posts/edit', [
            'post' => $post,
            'errors' => $validation['errors'],
        ]);
    }



    /**
     * Delete the given post and redirect to the post main page.
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request)
    {
        if (!$post = Post::find($request->routes('postId'))) return view('404');

        $post->delete();

        return redirect('admin/posts/index');
    }



    /**
     * Perform the form validation checking the data from the request.
     *
     * @param Request $request
     * @return array
     */
    private function validateForm(Request $request)
    {
        return $request->validate([
            'title' => 'required',
            'body' => '',
        ]);
    }
}
