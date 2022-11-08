<?php

namespace App\Http\Controllers\Admin\Posts\Categories;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoriesController extends Controller
{
    public function index()
    {
        $title = 'Semua Kategori';
        $categories = Categories::all();
        return view('admin.posts.category.index', [
            'title' => $title,
            'categories' => $categories,
        ]);
    }
    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);
        $slug = SlugService::createSlug(
            Categories::class,
            'slug',
            $request->name
        );
        $checkCategory = Categories::where('slug', $slug);
        if ($checkCategory->count() < 1) {
            Categories::create(['name' => $request->name, 'slug' => $slug]);
            return back()->with([
                'success' => 'Berhasil',
                'pesan' => 'memnbuat category baru',
            ]);
        }
        return back()->with([
            'danger' => 'Gagal',
            'pesan' => 'memnbuat category baru',
        ]);
    }
    public function deleteCategory($id)
    {
        $category = Categories::find($id);
        if ($category) {
            $category->delete();
            return back()->with([
                'success' => 'Berhasil',
                'pesan' => 'menghapus kategory',
            ]);
        }
        return back()->with([
            'danger' => 'Gagal',
            'pesan' => 'menghapus kategory',
        ]);
    }
}
