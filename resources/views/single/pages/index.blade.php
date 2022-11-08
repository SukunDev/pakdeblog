@extends('layouts.main')
@section('title', $page->title . ' | ' . strip_tags(App\Helpers\AppHelper::instance()->getOptions('site_name')))
@section('content')
    <div class="flex flex-col">
        {{-- Breadcrumbs --}}
        <nav>
            <ul class="flex items-center gap-2 text-xs md:text-sm">
                <li>
                    <a class="capitalize font-medium text-gray-600 hover:text-blue-500 transition duration-300" href="/"
                        title="Home">
                        Home
                    </a>
                </li>
                <li>
                    <svg class="w-[10px] fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path
                            d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                    </svg>
                </li>
                <li>
                    <p class="line-clamp-1 text-gray-500">{{ $page->title }}</p>
                </li>
            </ul>
        </nav>
        <div class="space-y-4 mt-8">
            <h1 class="text-xl font-semibold text-blue-500">{{ $page->title }}</h1>
            <div class="article">
                {!! $page->body !!}
            </div>
            <hr>
        </div>
    </div>
    <div id="preview-image" class="hidden">
        <div id="back-image" class="fixed inset-0 bg-black/70 z-[998]">
        </div>
        <div id="preview-image-show" class="fixed inset-0 m-auto w-fit h-fit z-[999]">
        </div>
    </div>
    <script>
        hljs.highlightAll();
    </script>
@endsection
