@extends('admin.layouts.main')
@section('content')
    <div class="space-y-4">
        <div class="max-w-full mx-auto mt-8">
            <div class="flex flex-col">
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden ">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-700 px-6 py-4 text-left">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Title
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Category
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Author
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            View
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @if ($posts->count() < 1)
                                        <tr
                                            class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                            <td colspan="4"
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 text-center">
                                                Tidak ada data di temukan
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($posts as $post)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ ($posts->currentPage() - 1) * $posts->perPage() + $loop->iteration }}
                                            </td>
                                            <td
                                                class="title-hover py-4 px-6 text-sm font-medium text-slate-700 whitespace-nowrap dark:text-white">
                                                {{ $post->title }}
                                                <div class="item-hover flex items-center font-light gap-2"
                                                    style="opacity: 0">
                                                    <a class="font-normal hover:text-blue-500"
                                                        href="/admin/posts/view/{{ $post->slug }}">View</a>
                                                    <span class="px-0.5 py-0.5 rounded-full bg-slate-600"></span>
                                                    <a class="font-normal hover:text-blue-500"
                                                        href="/admin/posts/edit/{{ $post->slug }}">Edit</a>
                                                    <span class="px-0.5 py-0.5 rounded-full bg-slate-600"></span>
                                                    <a class="font-normal text-red-500 hover:text-red-700"
                                                        href="/admin/posts/delete/{{ $post->id }}">Delete</a>
                                                </div>
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm font-medium text-slate-500 whitespace-nowrap dark:text-white">
                                                <a
                                                    href="/{{ Request::path() }}?category={{ $post->category->slug . (request()->query('search') ? '&search=' . request()->query('search') : '') . (request()->query('author') ? '&author=' . request()->query('author') : '') }}">
                                                    {{ $post->category->name }}
                                                </a>
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm font-medium text-slate-700 whitespace-nowrap dark:text-white">
                                                <a
                                                    href="/{{ Request::path() }}?author={{ $post->user->username . (request()->query('search') ? '&search=' . request()->query('search') : '') . (request()->query('category') ? '&category=' . request()->query('category') : '') }}">
                                                    {{ $post->user->name }}
                                                </a>
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm font-medium text-slate-700 whitespace-nowrap dark:text-white">
                                                <span class="flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-auto h-6 fill-slate-600" viewBox="0 0 24 24">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z" />
                                                    </svg>
                                                    {{ $post->view_count }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 text-sm font-light whitespace-nowrap dark:text-white">
                                                @if ($post->published_at)
                                                    <span
                                                        class="px-2 py-1 rounded-lg bg-blue-500 text-white">Published</span>
                                                @else
                                                    <span class="px-6 py-1 rounded-lg bg-red-600 text-white">Draft</span>
                                                @endif
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
        <div class="mt-10">
            @include('layouts.partials.pagination', ['paginator' => $posts])
        </div>
    </div>
@endsection
