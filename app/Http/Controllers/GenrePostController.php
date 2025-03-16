<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GenrePost;
use Illuminate\Http\Request;

class GenrePostController extends Controller
{
    public function index()
    {
        $genrePosts = GenrePost::latest()->get();
        return view('admin.genre_post.index', compact('genrePosts'));
    }

    public function create()
    {
        return view('admin.genre_post.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'status' => 'in:active,inactive',
            'type' => 'in:DANH SÁCH HƯỚNG DẪN CƠ BẢN,DANH SÁCH THỦ THUẬT KHÁC'
        ]);

        GenrePost::create($validatedData);

        return redirect()->route('genre_posts.index')
            ->with('success', 'Thể loại bài viết đã được tạo thành công.');
    }

    public function edit(GenrePost $genrePost)
    {
        return view('admin.genre_post.edit', compact('genrePost'));
    }

    public function update(Request $request, GenrePost $genrePost)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'status' => 'in:active,inactive',
            'type' => 'in:DANH SÁCH HƯỚNG DẪN CƠ BẢN,DANH SÁCH THỦ THUẬT KHÁC'
        ]);

        $genrePost->update($validatedData);

        return redirect()->route('genre_posts.index')
            ->with('success', 'Thể loại bài viết đã được cập nhật thành công.');
    }

    public function destroy(GenrePost $genrePost)
    {
        $genrePost->delete();

        return redirect()->route('genre_posts.index')
            ->with('success', 'Thể loại bài viết đã được xóa thành công.');
    }
}
