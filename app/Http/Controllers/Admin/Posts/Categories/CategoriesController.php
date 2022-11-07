<?php

namespace App\Http\Controllers\Admin\Posts\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $title = 'Semua Kategori';
        return view('admin.posts.category.index', ['title' => $title]);
    }
}
