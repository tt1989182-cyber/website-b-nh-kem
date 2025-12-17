<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Hiển thị danh sách bài viết
    public function index()
    {
        $posts = Post::with('user', 'comments', 'likes')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    // Form tạo bài viết
    public function create()
    {
        return view('posts.create');
    }

    // Lưu bài viết mới
    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('uploads', 'public');

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image_path' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->id());
    }

    // Hiển thị chi tiết bài viết
    public function show(Post $post)
    {
        $post->load('user', 'comments', 'likes');
        return view('posts.show', compact('post'));
    }

    // Form chỉnh sửa bài viết
    public function edit(Post $post)
    {
        if(auth()->id() !== $post->user_id){
            abort(403, 'Unauthorized action.');
        }

        return view('posts.edit', compact('post'));
    }

    // Cập nhật bài viết
    public function update(Request $request, Post $post)
    {
        if(auth()->id() !== $post->user_id){
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'caption' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('image')) {
            // Xóa ảnh cũ
            if($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }

            $data['image_path'] = $request->file('image')->store('uploads', 'public');
        }

        $post->update($data);

        return redirect('/posts/' . $post->id);
    }

    // Xóa bài viết
    public function destroy(Post $post)
    {
        if(auth()->id() !== $post->user_id){
            abort(403, 'Unauthorized action.');
        }

        if($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();

        return redirect('/profile/' . auth()->id());
    }
}
