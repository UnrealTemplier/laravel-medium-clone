<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post
            ::with(['user', 'media'])
            ->withCount('likes')
            ->latest()
            ->simplePaginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();

        $data['slug']    = Str::slug($data['title']);
        $data['user_id'] = Auth::id();

        /** @var Post $post */
        $post = Post::create($data);

        $post->addMediaFromRequest('image')->toMediaCollection('posts');

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user->id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::get();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        if ($post->user->id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validated();

        if (array_key_exists('title', $data)) {
            $data['slug'] = Str::slug($data['title']);
        }

        $post->update($data);

        if (array_key_exists('image', $data)) {
            $post->addMediaFromRequest('image')->toMediaCollection('posts');
        }

        return to_route('posts.show', [
            'username' => $post->user->username,
            'post'     => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user->id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        return to_route('dashboard');
    }

    public function category(Category $category)
    {
        $posts = $category->posts()
                          ->with(['user', 'media'])
                          ->withCount('likes')
                          ->latest()->simplePaginate(5);

        return view('posts.index', compact('posts'));
    }
}
