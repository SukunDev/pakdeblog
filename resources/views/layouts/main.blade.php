<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preload" href="{{ App\Helpers\AppHelper::instance()->getOptions('logo_url') }}" as="image">
    @yield('preload')
    <meta name="theme-color" content="#f3f4f6">
    <title>@yield('title', strip_tags(App\Helpers\AppHelper::instance()->getOptions('site_name')))</title>
    <meta name="title" content="@yield('title', strip_tags(App\Helpers\AppHelper::instance()->getOptions('site_name')))">
    <meta name="description" content="@yield('meta_description', App\Helpers\AppHelper::instance()->getOptions('description'))">
    <meta name="keywords" content="@yield('meta_keywords', App\Helpers\AppHelper::instance()->getOptions('keyword'))">
    <meta name="author" content="@yield('meta_author', App\Helpers\AppHelper::instance()->getOptions('admin_site'))">
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', strip_tags(App\Helpers\AppHelper::instance()->getOptions('site_name')))">
    <meta property="og:description" content="@yield('meta_description', App\Helpers\AppHelper::instance()->getOptions('description'))">
    <meta property="og:image" content="@yield('meta_thumbnail', env('APP_URL') . '/image/thumbnail_og.png')">

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', strip_tags(App\Helpers\AppHelper::instance()->getOptions('site_name')))">
    <meta property="twitter:description" content="@yield('meta_description', App\Helpers\AppHelper::instance()->getOptions('description'))">
    <meta property="twitter:image" content="@yield('meta_thumbnail', env('APP_URL') . '/image/thumbnail_og.png')">
    @php
        $meta_google_verification = App\Helpers\AppHelper::instance()->getOptions('google_verification_code');
        if ($meta_google_verification) {
            echo '<meta name="google-site-verification" content="' . $meta_google_verification . '" />';
        }
        $meta_yandex_verification = App\Helpers\AppHelper::instance()->getOptions('yandex_verification_code');
        if ($meta_yandex_verification) {
            echo '<meta name="yandex-verification" content="' . $meta_yandex_verification . '" />';
        }
        $meta_bing_verification = App\Helpers\AppHelper::instance()->getOptions('bing_verification_code');
        if ($meta_bing_verification) {
            echo '<meta name="msvalidate.01" content="' . $meta_bing_verification . '" />';
        }
        $meta_baidu_verification = App\Helpers\AppHelper::instance()->getOptions('baidu_verification_code');
        if ($meta_baidu_verification) {
            echo '<meta name="baidu-site-verification" content="' . $meta_bing_verification . '" />';
        }
    @endphp
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    {!! App\Helpers\AppHelper::instance()->getOptions('header_insert_code') !!}
</head>

<body>
    @include('layouts.partials.header')
    <div class="flex flex-col h-screen space-y-16">
        <div class="flex-grow">
            <div class="container mx-auto pt-[5rem]">
                <div class="block md:flex">
                    <main class="w-full md:w-4/6 px-4">
                        @yield('content')
                    </main>
                    <aside class="md:self-start md:sticky md:top-[4.5rem] mt-6 md:-mt-1 w-full md:w-2/6">
                        <div class="px-4">
                            @include('layouts.partials.sidebar')
                        </div>
                    </aside>
                </div>
            </div>
        </div>
        @include('layouts.partials.footer')
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    {!! App\Helpers\AppHelper::instance()->getOptions('footer_insert_code') !!}
</body>

</html>
