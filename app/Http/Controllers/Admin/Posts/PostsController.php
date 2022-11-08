<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Models\Tags;
use App\Models\Posts;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function editIndex(Posts $post)
    {
        $title = 'Edit Article';
        $categories = Categories::all();
        $tags = Tags::all();
        return view('admin.posts.edit.index', [
            'title' => $title,
            'categories' => $categories,
            'tags' => $tags,
            'post' => $post,
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
    public function insertPost(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'body' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['thumbnail'] = '';
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('image/thumbnail/'), $filename);
            $validatedData['thumbnail'] = asset('image/thumbnail/' . $filename);
        }
        $validatedData['excerpt'] = Str::limit(
            strip_tags($request->body),
            200,
            '...'
        );
        if ($request->visibilitas == 'publish') {
            $validatedData['published_at'] = now();
        } else {
            $validatedData['published_at'] = null;
        }
        $post = Posts::create($validatedData);
        if (!$post) {
            return back()->with([
                'danger' => 'Gagal',
                'pesan' => 'menyimpan article',
            ]);
        }
        $tagIds = [];
        if (!empty($request->get('tags'))) {
            foreach ($request->get('tags') as $tagName) {
                $tag = Tags::where('slug', $tagName)->first();
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            }
        }
        $post->tags()->sync($tagIds);
        return redirect('/admin/posts')->with([
            'success' => 'Berhasil',
            'pesan' => 'menyimpan article',
        ]);
    }
    public function changePost(Posts $post, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,user_id,' . auth()->user()->id,
            'category_id' => 'required',
            'body' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
        ]);
        if (!$post->thumbnail) {
            $validatedData['thumbnail'] = '';
        }
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('image/thumbnail/'), $filename);
            $validatedData['thumbnail'] = asset('image/thumbnail/' . $filename);
        }
        $validatedData['excerpt'] = Str::limit(
            strip_tags($request->body),
            200,
            '...'
        );
        if ($request->visibilitas == 'publish') {
            $validatedData['visibilitas'] = 'public';
            $validatedData['published_at'] = now();
        } else {
            $validatedData['visibilitas'] = $request->visibilitas;
            $validatedData['published_at'] = null;
        }
        $post->update($validatedData);
        $tagIds = [];
        if (!empty($request->get('tags'))) {
            foreach ($request->get('tags') as $tagName) {
                $tag = Tags::where('slug', $tagName)->first();
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            }
        }
        $post->tags()->sync($tagIds);
        if ($request->visibilitas == 'publish') {
            return redirect('/admin/posts')->with([
                'success' => 'Berhasil',
                'pesan' => 'menyimpan article',
            ]);
        } else {
            return redirect('/admin/posts')->with([
                'success' => 'Berhasil',
                'pesan' => 'menyimpan article',
            ]);
        }
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
