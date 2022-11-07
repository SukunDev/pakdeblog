<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title = 'Semua Pages';
        return view('admin.pages.index', ['title' => $title]);
    }
    public function createIndex()
    {
        $title = 'Tulis Pages';
        return view('admin.pages.create.index', ['title' => $title]);
    }
}
