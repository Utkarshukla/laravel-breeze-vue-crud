<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : Response
    {
        $posts= Post::with('categoryList')->with('postAuthor')->paginate(10);
        return Inertia::render('Welcome', [
           'posts'=>$posts,
           'postRoute' => route('posts.show', ['post' => '__post_id__']),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $post)
    {
        $post = Post::with('categoryList')->with('postAuthor')->with('comments')->findOrFail($post);
        return Inertia::render('Post',[
            'post'=>$post,
            'canLogin' => Route::has('login'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
