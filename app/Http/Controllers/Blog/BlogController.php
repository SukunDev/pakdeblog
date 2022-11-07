<?php

namespace App\Http\Controllers\Blog;

use App\Models\Posts;
use App\Models\PostView;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Posts::whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(5);
        $popularPost = Posts::whereNotNull('published_at')
            ->latest('view_count')
            ->limit(3)
            ->get();
        return view('index', [
            'posts' => $posts,
            'popular_post' => $popularPost,
        ]);
    }
    public function filterIndex($name, $value)
    {
        $filter = [$name => $value];
        $posts = Posts::whereNotNull('published_at')
            ->filter($filter)
            ->latest('published_at')
            ->paginate(5);
        $popularPost = Posts::whereNotNull('published_at')
            ->latest('view_count')
            ->limit(3)
            ->get();
        return view('index', [
            'posts' => $posts,
            'popular_post' => $popularPost,
        ]);
    }
    public function singlePost(Posts $post)
    {
        if (!$post->published_at) {
            return abort(404);
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

        if ($post->showPost()) {
            return view('single.index', [
                'post' => $post,
                'popular_post' => $popularPost,
                'related_post' => $relatedPost,
            ]);
        }
        $post->incrementViewsCount(); //count the view
        PostView::createViewLog($post);
        return view('single.index', [
            'post' => $post,
            'popular_post' => $popularPost,
            'related_post' => $relatedPost,
        ]);
    }
}
