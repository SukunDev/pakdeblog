@extends('layouts.main')
@section('content')
    @if ($posts->count() > 0)
        <div class="space-y-6">
            @component('layouts.partials.featuredarticle', ['post' => $posts[0]])
            @endcomponent
            @foreach ($posts->skip(1) as $post)
                @component('layouts.partials.article', ['post' => $post])
                @endcomponent
            @endforeach
            @include('layouts.partials.pagination', ['paginator' => $posts])
        </div>
    @else
        <div class="flex justify-center text-gray-500 font-bold">
            <p>Tidak ada article di temukan</p>
        </div>
    @endif
@endsection
