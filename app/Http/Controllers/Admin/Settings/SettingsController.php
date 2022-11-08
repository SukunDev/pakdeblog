<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $title = 'Settings Umum';
        $settings = [
            'site_name' => AppHelper::instance()->getOptions('site_name'),
            'site_url' => AppHelper::instance()->getOptions('site_url'),
            'description' => AppHelper::instance()->getOptions('description'),
            'keyword' => AppHelper::instance()->getOptions('keyword'),
            'logo_url' => AppHelper::instance()->getOptions('logo_url'),
            'google_verification_code' => AppHelper::instance()->getOptions(
                'google_verification_code'
            ),
            'yandex_verification_code' => AppHelper::instance()->getOptions(
                'yandex_verification_code'
            ),
            'bing_verification_code' => AppHelper::instance()->getOptions(
                'bing_verification_code'
            ),
            'baidu_verification_code' => AppHelper::instance()->getOptions(
                'baidu_verification_code'
            ),
            'header_insert_code' => AppHelper::instance()->getOptions(
                'header_insert_code'
            ),
            'sidebar_insert_code' => AppHelper::instance()->getOptions(
                'sidebar_insert_code'
            ),
            'footer_insert_code' => AppHelper::instance()->getOptions(
                'footer_insert_code'
            ),
        ];
        return view('admin.settings.index', [
            'title' => $title,
            'settings' => $settings,
        ]);
    }
    public function menuIndex()
    {
        $title = 'Settings Menu';
        $settings = [
            'header_menu' => json_decode(
                AppHelper::instance()->getOptions('header_menu'),
                true
            ),
            'footer_menu' => json_decode(
                AppHelper::instance()->getOptions('footer_menu'),
                true
            ),
        ];
        return view('admin.settings.menu.index', [
            'title' => $title,
            'settings' => $settings,
        ]);
    }
    public function changeSiteInfo(Request $request)
    {
        $request->validate([
            'site_name' => 'required',
            'description' => 'required',
            'keyword' => 'required',
        ]);
        $data = $request->except(['_token', 'logo_file', 'favicon_file']);
        foreach ($data as $name => $value) {
            if (!AppHelper::instance()->updateOptions($name, $value)) {
                return back()->with([
                    'danger' => 'Gagal',
                    'pesan' => 'tidak bisa menyimpan' . $name,
                ]);
            }
        }
        if ($request->hasFile('logo_file')) {
            $extensions = ['png'];
            $file = $request->file('logo_file');
            if (in_array($file->getClientOriginalExtension(), $extensions)) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path('image/'), $filename);
                if (
                    !AppHelper::instance()->updateOptions(
                        'logo_url',
                        '/image/' . $filename
                    )
                ) {
                    return back()->with([
                        'danger' => 'Gagal',
                        'pesan' => 'tidak bisa menyimpan logo',
                    ]);
                }
            } else {
                return back()->with([
                    'danger' => 'Gagal',
                    'pesan' => 'hanya file png yang dapat di simpan',
                ]);
            }
        }
        if ($request->hasFile('favicon_file')) {
            $extensions = ['ico'];
            $file = $request->file('favicon_file');
            if (in_array($file->getClientOriginalExtension(), $extensions)) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path(), 'favicon.ico');
            } else {
                return back()->with([
                    'danger' => 'Gagal',
                    'pesan' => 'hanya file ico yang dapat di simpan',
                ]);
            }
        }
        return back()->with([
            'success' => 'Berhasil',
            'pesan' => 'menyimpan semua perubahan',
        ]);
    }
    public function changeMenu(Request $request)
    {
        $data = $request->except(['_token']);
        foreach ($data as $name => $value) {
            if (!AppHelper::instance()->updateOptions($name, $value)) {
                return back()->with([
                    'danger' => 'Gagal',
                    'pesan' => 'tidak bisa menyimpan' . $name,
                ]);
            }
        }
        return back()->with([
            'success' => 'Berhasil',
            'pesan' => 'menyimpan semua perubahan',
        ]);
    }
}
