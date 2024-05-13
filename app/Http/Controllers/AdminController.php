<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts= Post::with('categoryList')->paginate(10);
        return Inertia::render('Dashboard', [
            'posts'=>$posts,
            'postRoute' => route('posts.show', ['post' => '__post_id__']),
            'editRoute'=>route('post.edit',['id'=>'__post_edit__']),
            'deleteRoute'=>route('post.delete',['id'=>'__post_delete__']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category=Category::all();
        return Inertia::render('Post/Create',[
            'category'=>$category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'short_description' => 'required|string',
        'long_description'=>'required|string',
        'thumbnail'=>'nullable|mimes:png,jpg,jpeg,avif,webp',
        'category_id'=>'required',
    ]);
    
    
    if ($request->hasFile('thumbnail')) {
        $thumbnail = $request->file('thumbnail');
        $thumbnailPath = $thumbnail->store('thumbnails', 'public');
        $validatedData['thumbnail'] = $thumbnailPath;
    }
    $validatedData['author']= Auth::id();
     Post::create($validatedData);

  return redirect()->route('dashboard');
    
    
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::with('categoryList')->findOrFail($id);
        $category=Category::all();
        return Inertia::render('Post/Edit',[
            'post'=>$post,
            'category'=>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request){
    $validatedData = $request->validate([
        'title' => 'required',
        'short_description' => 'required',
        'long_description' => 'required',
        // 'thumbnail' => 'nullable|mimes:png,jpg,jpeg,avif,webp',
        'category_id' => 'required',
    ]);
    
    $post= Post::find($request['id']);
    
    if ($request->hasFile('thumbnail')) {
        $thumbnail = $request->file('thumbnail');
        $thumbnailPath = $thumbnail->store('thumbnails', 'public');
        $validatedData['thumbnail'] = $thumbnailPath;
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
    }

    $post->update($validatedData);

    return response()->json(['status' => 'success', 'message' => 'Post updated successfully'], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
{
    $post = Post::findOrFail($id);
    $post->delete();
    
    return redirect()->route('dashboard');
}

}
