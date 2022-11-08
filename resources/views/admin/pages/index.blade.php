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
                                            slug
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @if ($pages->count() < 1)
                                        <tr
                                            class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                            <td colspan="4"
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 text-center">
                                                Tidak ada data di temukan
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($pages as $page)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ ($pages->currentPage() - 1) * $pages->perPage() + $loop->iteration }}
                                            </td>
                                            <td
                                                class="title-hover py-4 px-6 text-sm font-medium text-slate-700 whitespace-nowrap dark:text-white">
                                                {{ $page->title }}
                                                <div class="item-hover flex items-center font-light gap-2"
                                                    style="opacity: 0">
                                                    <a class="font-normal hover:text-blue-500"
                                                        href="/admin/pages/view/{{ $page->slug }}">View</a>
                                                    <span class="px-0.5 py-0.5 rounded-full bg-slate-600"></span>
                                                    <a class="font-normal hover:text-blue-500"
                                                        href="/admin/pages/edit/{{ $page->slug }}">Edit</a>
                                                    <span class="px-0.5 py-0.5 rounded-full bg-slate-600"></span>
                                                    <a class="font-normal text-red-500 hover:text-red-700"
                                                        href="/admin/pages/delete/{{ $page->id }}">Delete</a>
                                                </div>
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm font-medium text-slate-700 whitespace-nowrap dark:text-white">
                                                /p/{{ $page->slug }}
                                            </td>
                                            <td class="py-4 px-6 text-sm font-light whitespace-nowrap dark:text-white">
                                                @if ($page->published_at)
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
            @include('layouts.partials.pagination', ['paginator' => $pages])
        </div>
    </div>
@endsection
