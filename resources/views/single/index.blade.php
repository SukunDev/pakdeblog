@extends('layouts.main')
@section('title', $post->title . ' | ' . strip_tags(App\Helpers\AppHelper::instance()->getOptions('site_name')))
@section('meta_keywords', $post->meta_keyword)
@section('meta_description', $post->meta_description)
@section('meta_author', $post->user->username)
@section('meta_thumbnail', $post->thumbnail)
@section('preload')
    @if ($post->thumbnail)
        <link rel="preload" href="{{ $post->thumbnail }}" as="image">
    @endif
@endsection
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
                @if ($post->category)
                    <li>
                        <a class="capitalize font-medium text-gray-600 hover:text-blue-500 transition duration-300 whitespace-nowrap"
                            href="/category/{{ $post->category->slug }}" title="{{ $post->category->name }}">
                            {{ $post->category->name }}
                        </a>
                    </li>
                    <li>
                        <svg class="w-[10px] fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                        </svg>
                    </li>
                @endif
                <li>
                    <p class="line-clamp-1 text-gray-500">{{ $post->title }}</p>
                </li>
            </ul>
        </nav>
        <div class="space-y-4 mt-8">
            <h1 class="text-xl font-semibold text-blue-500">{{ $post->title }}</h1>
            @if ($post->thumbnail)
                <div class="relative">
                    <div class="aspect-w-16 aspect-h-9">
                        <img class="w-full object-cover rounded-md" src="{{ $post->thumbnail }}" alt="{{ $post->title }}"
                            loading="lazy">
                    </div>
                    <span class="absolute top-1 left-1 px-3 py-1 rounded-full bg-blue-500 text-white text-xs">
                        {{ Carbon\Carbon::parse($post->published_at)->format('d, M Y') }}
                    </span>
                </div>
            @endif
            <div class="article">
                {!! $post->body !!}
            </div>
            <hr>
            @include('layouts.partials.socialmediashare')
            @if ($post->tags && $post->tags->count() > 0)
                <div class="flex flex-wrap items-center gap-2">
                    @if ($post->tags->count() > 1)
                        @foreach ($post->tags as $tag)
                            <a href="/tag/{{ $tag->slug }}" class="px-4 py-1.5 rounded-lg bg-blue-500 text-white text-sm"
                                title="{{ $tag->name }}">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    @else
                        <a href="/tag/{{ $post->tags[0]->slug }}"
                            class="px-4 py-1.5 rounded-lg bg-blue-500 text-white text-sm"
                            title="{{ $post->tags[0]->name }}">
                            {{ $post->tags[0]->name }}
                        </a>
                    @endif
                </div>
            @endif
            @component('layouts.partials.relatedpost', ['related_post' => $related_post])
            @endcomponent
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
        var inline_related_post = <?php
        $newRelatedPost = [];
        foreach ($related_post as $post) {
            $newRelatedPost[] = [
                'title' => $post->title,
                'slug' => $post->slug,
            ];
        }
        echo json_encode($newRelatedPost);
        ?>
    </script>
@endsection
