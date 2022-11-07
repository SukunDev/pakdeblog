<?php

namespace App\Http\Controllers\Admin\Posts\Tags;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $title = 'Semua Tags';
        return view('admin.posts.tags.index', ['title' => $title]);
    }
}
