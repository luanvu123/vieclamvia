<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GenrePost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        // Tạo slug từ tên
        $slug = Str::slug($validatedData['name']);

        // Kiểm tra xem slug đã tồn tại chưa
        $count = GenrePost::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        // Nếu slug đã tồn tại thì thêm số vào cuối
        $validatedData['slug'] = $count ? "{$slug}-{$count}" : $slug;

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

        // Kiểm tra xem tên có thay đổi không
        if ($genrePost->name !== $validatedData['name']) {
            // Tạo slug từ tên mới
            $slug = Str::slug($validatedData['name']);

            // Kiểm tra xem slug đã tồn tại chưa (ngoại trừ chính nó)
            $count = GenrePost::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")
                ->where('id', '!=', $genrePost->id)
                ->count();

            // Nếu slug đã tồn tại thì thêm số vào cuối
            $validatedData['slug'] = $count ? "{$slug}-{$count}" : $slug;
        }

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
