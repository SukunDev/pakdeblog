@extends('admin.layouts.main')
@section('content')
    <div class="space-y-4">
        <div class="px-4 py-4 rounded-md bg-white shadow-md">
            <form class="space-y-4" action="/{{ Request::path() }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="titleForm">Title</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="text" name="title" id="titleForm" value="{{ old('title') }}" required>
                </div>
                <div id="permalink" class="px-1 flex items-center" style="display: none">
                    <p class="font-medium line-clamp-1">Permalink: <span
                            class="text-blue-500 hover:underline font-normal cursor-pointer">{{ App\Helpers\AppHelper::instance()->getOptions('site_url') }}/p/</span>
                    </p>
                    <div id="edit-permalink" class="flex items-end" style="display: none">
                        <input
                            class="px-4 py-1 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                            type="text" name="slug" id="slugForm" value="{{ old('slug') }}" required>
                        <button id="permalink-ok"
                            class="ml-2 px-1.5 py-1.5 text-sm rounded-md bg-green-500 hover:bg-green-600 active:bg-green-500 transition duration-300 text-white"
                            type="button">OK</button>
                        <button id="permalink-cancel" class="ml-2 text-sm text-blue-500 hover:underline"
                            type="button">Cancel</button>
                    </div>
                    <button id="permalink-edit"
                        class="ml-2 px-1.5 py-1.5 text-sm rounded-md bg-blue-500 hover:bg-blue-600 active:bg-blue-500 transition duration-300 text-white"
                        type="button">Edit</button>
                </div>
                <div class="flex flex-col">
                    <label for="editor" class="capitalize font-medium">Content</label>
                    <textarea name="body" id="editor">{{ old('body') }}</textarea>
                </div>
                <div class="flex gap-4 items-center justify-center">
                    <button
                        class="px-4 py-2 rounded-md text-white bg-green-500 hover:bg-green-600 active:bg-green-500 transition duration-300"
                        name="visibilitas" value="publish" type="submit">Publish</button>
                    <button
                        class="px-4 py-2 rounded-md text-white bg-slate-800 hover:bg-slate-700 active:bg-slate-800 transition duration-300"
                        name="visibilitas" value="draft" type="submit">Save Draft</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).on("keydown", "form", function(event) {
            return event.key != "Enter";
        });
        $(document).ready(function() {
            var permalinkSlug = ""
            $('#titleForm').on('change', function() {
                fetch('/api/posts/checkSlug?title=' + $(this).val())
                    .then(response => response.json())
                    .then(function(data) {
                        permalinkSlug = data.slug
                        $('#slugForm').val(permalinkSlug)
                        var permalink = $('#permalink')
                        permalink.find('span').text(
                            "{{ App\Helpers\AppHelper::instance()->getOptions('site_url') }}/p/" +
                            permalinkSlug)
                        permalink.show()
                    })
            });
            $('#permalink-edit').on('click', function() {
                $('#edit-permalink').show()
                $(this).hide()
                var permalink = $('#permalink')
                permalink.find('span').text(
                    "{{ App\Helpers\AppHelper::instance()->getOptions('site_url') }}/p/")
            })
            $('#permalink-ok').on('click', function() {
                permalinkSlug = $('#slugForm').val()
                var permalink = $('#permalink')
                permalink.find('span').text(
                    "{{ App\Helpers\AppHelper::instance()->getOptions('site_url') }}/p/" + permalinkSlug
                )
                $('#edit-permalink').hide()
                $('#permalink-edit').show()
            })
            $('#permalink-cancel').on('click', function() {
                var permalink = $('#permalink')
                $('#slugForm').val(permalinkSlug)
                permalink.find('span').text(
                    "{{ App\Helpers\AppHelper::instance()->getOptions('site_url') }}/p/" + permalinkSlug
                )
                $('#edit-permalink').hide()
                $('#permalink-edit').show()
            })
            var content = CKEDITOR.replace('editor', {
                filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token='
            });

        })
    </script>
@endsection
