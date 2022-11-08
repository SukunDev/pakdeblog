<?php

namespace App\Http\Controllers\Admin\Posts\Tags;

use App\Models\Tags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

class TagsController extends Controller
{
    public function index()
    {
        $title = 'Semua Tags';
        $tags = Tags::all();
        return view('admin.posts.tags.index', [
            'title' => $title,
            'tags' => $tags,
        ]);
    }
    public function createTags(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags',
        ]);
        $slug = SlugService::createSlug(Tags::class, 'slug', $request->name);
        $checkTags = Tags::where('slug', $slug);
        if ($checkTags->count() < 1) {
            Tags::create(['name' => $request->name, 'slug' => $slug]);
            return back()->with([
                'success' => 'Berhasil',
                'pesan' => 'memnbuat tags baru',
            ]);
        }
        return back()->with([
            'danger' => 'Gagal',
            'pesan' => 'memnbuat tags baru',
        ]);
    }
    public function deleteTags($id)
    {
        $tags = Tags::find($id);
        if ($tags) {
            $tags->delete();
            return back()->with([
                'success' => 'Berhasil',
                'pesan' => 'menghapus tags',
            ]);
        }
        return back()->with([
            'danger' => 'Gagal',
            'pesan' => 'menghapus tags',
        ]);
    }
}
