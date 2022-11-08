<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Models\Pages;
use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index()
    {
        $title = 'Semua Pages';
        $pages = Pages::latest()->paginate(10);
        return view('admin.pages.index', [
            'title' => $title,
            'pages' => $pages,
        ]);
    }
    public function createIndex()
    {
        $title = 'Tulis Pages';
        return view('admin.pages.create.index', ['title' => $title]);
    }
    public function editIndex(Pages $page)
    {
        $title = 'Edit Pages';
        return view('admin.pages.edit.index', [
            'title' => $title,
            'page' => $page,
        ]);
    }
    public function viewIndex(Pages $page)
    {
        if ($page->published_at) {
            return redirect('/p/' . $page->slug);
        }
        $popularPost = Posts::whereNotNull('published_at')
            ->latest('view_count')
            ->limit(3)
            ->get();
        return view('single.pages.index', [
            'page' => $page,
            'popular_post' => $popularPost,
        ]);
    }
    public function addPages(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:pages',
            'body' => 'required',
        ]);
        if ($request->visibilitas == 'publish') {
            $validatedData['published_at'] = now();
        } else {
            $validatedData['published_at'] = null;
        }
        $validatedData['user_id'] = auth()->user()->id;
        $pages = Pages::create($validatedData);
        if (!$pages) {
            return back()->with([
                'danger' => 'Gagal',
                'pesan' => 'menyimpan page',
            ]);
        }
        return redirect('/admin/pages')->with([
            'success' => 'Berhasil',
            'pesan' => 'menyimpan page',
        ]);
    }
    public function changePages(Pages $page, Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:pages,user_id,' . auth()->user()->id,
            'body' => 'required',
        ]);
        if ($request->visibilitas == 'publish') {
            $validatedData['published_at'] = now();
        } else {
            $validatedData['published_at'] = null;
        }
        $page->update($validatedData);
        if (!$page) {
            return back()->with([
                'danger' => 'Gagal',
                'pesan' => 'menyimpan page',
            ]);
        }
        return redirect('/admin/pages')->with([
            'success' => 'Berhasil',
            'pesan' => 'menyimpan page',
        ]);
    }
    public function deletePages($id)
    {
        $pages = Pages::find($id);
        $pages->delete();
        return back()->with([
            'success' => 'Berhasil',
            'pesan' => 'menghapus page',
        ]);
    }
}
