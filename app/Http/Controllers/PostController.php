<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller implements HasMiddleware
{
    public static function middleware() : array
    {
        return [
            new Middleware('auth', except: ['index', 'show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate();
        return view('posts.index', ['posts' => $posts]);
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
        // Validate the request
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
        ]);

        // Create a new post
        Auth::user()->posts()->create($fields);
        return back()->with('success','Your post has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('modify', $post); // Check if the user can modify the post (PostPolicy)
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validate the request
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
        ]);

        // Update the post
        $post->update($fields);
        return redirect()->route('dashboard')->with('success','Your post has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('delete', 'Your post has been deleted successfully.');
    }
}
