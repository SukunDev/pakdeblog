@extends('admin.layouts.main')
@section('content')
    <div class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @component('admin.layouts.partials.card', ['name' => 'Jumlah Article', 'value' => $jumlah_article])
                <svg class="w-20 mr-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
                </svg>
            @endcomponent
            @component('admin.layouts.partials.card', ['name' => 'Views Bulan Ini', 'value' => $page_view_month->count()])
                <svg class="w-24 mb-4 mr-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M304 240V16.6c0-9 7-16.6 16-16.6C443.7 0 544 100.3 544 224c0 9-7.6 16-16.6 16H304zM32 272C32 150.7 122.1 50.3 239 34.3c9.2-1.3 17 6.1 17 15.4V288L412.5 444.5c6.7 6.7 6.2 17.7-1.5 23.1C371.8 495.6 323.8 512 272 512C139.5 512 32 404.6 32 272zm526.4 16c9.3 0 16.6 7.8 15.4 17c-7.7 55.9-34.6 105.6-73.9 142.3c-6 5.6-15.4 5.2-21.2-.7L320 288H558.4z" />
                </svg>
            @endcomponent
            @component('admin.layouts.partials.card', ['name' => 'Views Minggu Ini', 'value' => $page_view_week->count()])
                <svg class="w-24 mb-4 mr-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M304 240V16.6c0-9 7-16.6 16-16.6C443.7 0 544 100.3 544 224c0 9-7.6 16-16.6 16H304zM32 272C32 150.7 122.1 50.3 239 34.3c9.2-1.3 17 6.1 17 15.4V288L412.5 444.5c6.7 6.7 6.2 17.7-1.5 23.1C371.8 495.6 323.8 512 272 512C139.5 512 32 404.6 32 272zm526.4 16c9.3 0 16.6 7.8 15.4 17c-7.7 55.9-34.6 105.6-73.9 142.3c-6 5.6-15.4 5.2-21.2-.7L320 288H558.4z" />
                </svg>
            @endcomponent
        </div>
        <p class="text-lg font-medium">Statistic</p>
        <div class="px-4 py-4 rounded-md bg-white shadow-md border border-gray-200">
            <div id="statisticChart"
                style="position: relative; height: 380px; width: 100%; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
            </div>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div class="bg-white shadow-md px-4 py-4 rounded-md">
                <p class="text-lg font-medium">Popular Article</p>
                <div class="max-w-full mx-auto">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full">
                                        <thead class="bg-white border-b">
                                            <tr>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-700 px-6 py-4 text-left">
                                                    #
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                                    title
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                                    view
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($popular_post as $post)
                                                <tr
                                                    class="alat-hover bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                        {{ $loop->index + 1 }}
                                                    </td>
                                                    <td class="text-sm text-gray-500 px-6 py-4 capitalize">
                                                        <span class="line-clamp-1">{{ $post->title }}</span>
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap capitalize">
                                                        {{ $post->view_count }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2 bg-white shadow-md px-4 py-4 rounded-md">
                <p class="text-lg font-medium">Pengunjung Terakhir</p>
                <div class="max-w-full mx-auto">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full">
                                        <thead class="bg-white border-b">
                                            <tr>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-700 px-6 py-4 text-left">
                                                    #
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                                    ip
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                                    user agent
                                                </th>
                                                <th scope="col"
                                                    class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                                    date
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($page_view_month->count() < 1)
                                                <tr
                                                    class="alat-hover bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                                    <td colspan="5"
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center capitalize">
                                                        belum ada catatan
                                                    </td>
                                                </tr>
                                            @endif
                                            @foreach ($page_view_month->take(5) as $item)
                                                <tr
                                                    class="alat-hover bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                        {{ $item->id }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap capitalize">
                                                        {{ $item->ip }}
                                                    </td>
                                                    <td class="text-sm text-gray-500 px-6 py-4 capitalize">
                                                        <span class="line-clamp-1">{{ $item->agent }}</span>
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap capitalize">
                                                        {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            new Morris.Line({
                element: 'statisticChart',
                resize: true,
                data: {!! $data_chart !!},
                xkey: 'date',
                xLabels: 'day',
                ykeys: ['views'],
                labels: ['Views'],
                lineColors: ['#0440bc'],
                lineWidth: 2,
                hideHover: 'auto',
                smooth: false
            });
        });
    </script>
@endsection
