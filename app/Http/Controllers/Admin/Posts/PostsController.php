<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Tags;

class PostsController extends Controller
{
    public function index()
    {
        $title = 'Semua Article';
        $posts = Posts::latest()
            ->filter(request(['search', 'category', 'author', 'tags']))
            ->paginate(10)
            ->withQueryString();
        return view('admin.posts.index', [
            'title' => $title,
            'posts' => $posts,
        ]);
    }
    public function createIndex()
    {
        $title = 'Tulis Article';
        $categories = Categories::all();
        $tags = Tags::all();
        return view('admin.posts.create.index', [
            'title' => $title,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
    public function viewIndex(Posts $post)
    {
        if ($post->published_at) {
            return redirect('/' . $post->slug);
        }
        $relatedPost = Posts::whereNotNull('published_at')
            ->where('category_id', $post->category->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        $popularPost = Posts::whereNotNull('published_at')
            ->latest('view_count')
            ->limit(3)
            ->get();
        return view('single.index', [
            'post' => $post,
            'popular_post' => $popularPost,
            'related_post' => $relatedPost,
        ]);
    }
    public function deletePost($id)
    {
        $post = Posts::find($id);
        $post->tags()->sync([]);
        $post->delete();
        return back()->with([
            'success' => 'Berhasil',
            'pesan' => 'menghapus article',
        ]);
    }
}
