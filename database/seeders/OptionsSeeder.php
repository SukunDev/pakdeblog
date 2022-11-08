<?php

namespace Database\Seeders;

use App\Models\Options;
use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Options::create(['name' => 'admin_site', 'value' => 'PakdeKun']);
        Options::create([
            'name' => 'site_name',
            'value' => '<strong>Pakde</strong>Kun',
        ]);
        Options::create([
            'name' => 'description',
            'value' => 'pakdekun situs',
        ]);
        Options::create([
            'name' => 'keyword',
            'value' => 'pakdekun',
        ]);
        Options::create([
            'name' => 'site_url',
            'value' => env('APP_URL'),
        ]);
        Options::create([
            'name' => 'logo_url',
            'value' => '/image/PakdeKun.png',
        ]);
        Options::create([
            'name' => 'header_menu',
            'value' => json_encode([
                'home' => env('APP_URL'),
                'programing' => env('APP_URL') . '/category/programing',
                'web design' => env('APP_URL') . '/category/web-design',
                'personal' => env('APP_URL') . '/category/personal',
            ]),
        ]);
        Options::create([
            'name' => 'footer_menu',
            'value' => json_encode([
                'about' => env('APP_URL') . '/p/about',
                'contact us' => env('APP_URL') . '/contact',
                'disclaimer' => env('APP_URL') . '/p/disclaimer',
                'privacy policy' => env('APP_URL') . '/p/privacy-policy',
            ]),
        ]);
        Options::create([
            'name' => 'google_verification_code',
            'value' => '',
        ]);
        Options::create([
            'name' => 'yandex_verification_code',
            'value' => '',
        ]);
        Options::create([
            'name' => 'bing_verification_code',
            'value' => '',
        ]);
        Options::create([
            'name' => 'baidu_verification_code',
            'value' => '',
        ]);
        Options::create([
            'name' => 'header_insert_code',
            'value' => '',
        ]);
        Options::create([
            'name' => 'sidebar_insert_code',
            'value' => '',
        ]);
        Options::create([
            'name' => 'footer_insert_code',
            'value' => '',
        ]);
    }
}
