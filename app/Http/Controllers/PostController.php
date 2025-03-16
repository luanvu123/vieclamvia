<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\GenrePost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('genrePost')->latest()->get();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $genrePosts = GenrePost::where('status', 'active')->get();
        return view('admin.post.create', compact('genrePosts'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'in:active,inactive',
            'genre_post_id' => 'required|exists:genre_posts,id'
        ]);

        // Xử lý upload hình ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Tạo slug
        $validatedData['slug'] = Str::slug($validatedData['name']);

        Post::create($validatedData);

        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được tạo thành công.');
    }

    public function edit(Post $post)
    {
        $genrePosts = GenrePost::where('status', 'active')->get();
        return view('admin.post.edit', compact('post', 'genrePosts'));
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'in:active,inactive',
            'genre_post_id' => 'required|exists:genre_posts,id'
        ]);

        // Xử lý upload hình ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Tạo slug
        $validatedData['slug'] = Str::slug($validatedData['name']);

        $post->update($validatedData);

        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được xóa thành công.');
    }
}
