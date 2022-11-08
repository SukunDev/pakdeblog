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
                        type="text" name="title" id="titleForm" value="{{ $post->title }}" required>
                </div>
                <div id="permalink" class="px-1 flex items-center">
                    <p class="font-medium line-clamp-1">Permalink: <span
                            class="text-blue-500 hover:underline font-normal cursor-pointer">{{ App\Helpers\AppHelper::instance()->getOptions('site_url') }}/{{ $post->title }}</span>
                    </p>
                    <div id="edit-permalink" class="flex items-end" style="display: none">
                        <input
                            class="px-4 py-1 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                            type="text" name="slug" id="slugForm" value="{{ $post->slug }}" required>
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
                    <label class="capitalize font-medium" for="categoryForm">Category</label>
                    <select
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        name="category_id" id="categoryForm">
                        <option class="capitalize" value="">Pilih Kategory
                        </option>
                        @foreach ($categories as $category)
                            <option class="capitalize" value="{{ $category->id }}"
                                {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div id="tags" class="flex flex-col">
                    <p class="capitalize font-medium">Tags</p>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach ($tags as $tag)
                            <div class="flex gap-2">
                                <input type="checkbox" name="tags[]" id="tag-{{ $tag->slug }}"
                                    value="{{ $tag->slug }}"
                                    @php foreach ($post->tags as $postTag) {
                                            if ($tag->name == $postTag->name) {
                                                echo 'checked';
                                            }
                                        } @endphp>
                                <label for="tag-{{ $tag->slug }}">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-full sm:w-2/3 lg:w-1/2 flex flex-col">
                    <p class="capitalize font-medium">thumbnail</p>
                    <label
                        class="aspect-w-16 aspect-h-10 border-2 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300">
                        <div id="tempatGambar"
                            class="absolute inset-0 m-auto h-fit w-fit {{ $post->thumbnail ? 'hidden' : '' }}">
                            <div class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                    Attach a file</p>
                            </div>
                        </div>
                        <img class="w-full object-contain absolute inset-0 m-auto {{ $post->thumbnail ? '' : 'hidden' }}"
                            src="{{ $post->thumbnail }}" id="output" />
                        <input type="file" class="opacity-0" name="thumbnail" onchange="loadFile(event)" />
                    </label>
                </div>
                <div class="flex flex-col">
                    <label for="editor" class="capitalize font-medium">Content</label>
                    <textarea name="body" id="editor">{{ $post->body }}</textarea>
                </div>
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="metaDiscriptionForm">meta discription</label>
                    <textarea id="metaDiscriptionForm" rows="3"
                        class="px-4 py-2 rounded-md bg-gray-100 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        placeholder="jumlah karakter max 160" name="meta_description" required>{{ $post->meta_description }}</textarea>
                    <div id="the-count" class="flex justify-end gap-1">
                        <span id="current">0</span>
                        <span id="maximum">/ 160</span>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="metaKeywordForm">meta keyword</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="text" name="meta_keyword" id="metaKeywordForm" value="{{ $post->meta_keyword }}"
                        required>
                </div>
                <div class="flex gap-4 items-center justify-center">
                    <button
                        class="px-4 py-2 rounded-md text-white bg-green-500 hover:bg-green-600 active:bg-green-500 transition duration-300"
                        name="visibilitas" value="publish" type="submit">Publish</button>
                    <button
                        class="px-4 py-2 rounded-md text-white bg-slate-800 hover:bg-slate-700 active:bg-slate-800 transition duration-300"
                        name="visibilitas" value="draft" type="submit">Save Draft</button>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).on("keydown", "form", function(event) {
            return event.key != "Enter";
        });
        var loadFile = function(event) {
            var reader = new FileReader();
            var tempatGambar = document.getElementById('tempatGambar');
            reader.onload = function() {
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            output.style.display = "block";
            tempatGambar.style.display = "none";
            reader.readAsDataURL(event.target.files[0]);
        };
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
                    "{{ App\Helpers\AppHelper::instance()->getOptions('site_url') }}/p/" +
                    permalinkSlug
                )
                $('#edit-permalink').hide()
                $('#permalink-edit').show()
            })
            $('#permalink-cancel').on('click', function() {
                var permalink = $('#permalink')
                $('#slugForm').val(permalinkSlug)
                permalink.find('span').text(
                    "{{ App\Helpers\AppHelper::instance()->getOptions('site_url') }}/p/" +
                    permalinkSlug
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
            $('#metaDiscriptionForm').keyup(function() {
                metaCharacterCount()
            });
            metaCharacterCount()
        })

        function metaCharacterCount() {
            var characterCount = $('#metaDiscriptionForm').val().length,
                current = $('#current'),
                maximum = $('#maximum'),
                theCount = $('#the-count');
            current.text(characterCount);
            /*This isn't entirely necessary, just playin around*/
            if (characterCount < 80) {
                current.css('color', '#666');
                maximum.css('color', '#666');
                theCount.css('font-weight', 'normal');
            }
            if (characterCount > 80 && characterCount < 135) {
                current.css('color', 'rgb(234 179 8 / 1)');
                theCount.css('font-weight', 'normal');
            }
            if (characterCount > 135 && characterCount < 155) {
                current.css('color', 'rgb(34 197 94 / 1)');
                maximum.css('color', '#666');
                theCount.css('font-weight', 'normal');
            }
            if (characterCount > 155 && characterCount <= 160) {
                current.css('color', 'rgb(34 197 94 / 1)');
                maximum.css('color', 'rgb(34 197 94 / 1)');
                theCount.css('font-weight', 'bold');
            }
            if (characterCount > 160) {
                current.css('color', '#8f0001');
                maximum.css('color', '#8f0001');
                theCount.css('font-weight', 'bold');
            }
        }
    </script>
@endsection
