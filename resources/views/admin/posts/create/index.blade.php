@extends('admin.layouts.main')
@section('content')
    <div class="space-y-4">
        <div class="px-4 py-4 rounded-md bg-white shadow-md">
            <form class="space-y-4" action="/{{ Request::path() }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="post_id" id="postIdForm" value="">
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="titleForm">Title</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="text" name="title" id="titleForm" value="{{ old('title') }}" required>
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
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                    value="{{ $tag->slug }}">
                                <label for="tag-{{ $tag->slug }}">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-full sm:w-2/3 lg:w-1/2 flex flex-col">
                    <p class="capitalize font-medium">thumbnail</p>
                    <label
                        class="aspect-w-16 aspect-h-10 border-2 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300">
                        <div id="tempatGambar" class="absolute inset-0 m-auto h-fit w-fit">
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
                        <img class="w-full object-contain absolute inset-0 m-auto hidden" id="output" />
                        <input type="file" class="opacity-0" name="thumbnail" onchange="loadFile(event)" />
                    </label>
                </div>
                <div class="flex flex-col">
                    <label for="editor" class="capitalize font-medium">Content</label>
                    <textarea name="body" id="editor">{{ old('body') }}</textarea>
                </div>
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
            $('#titleForm').on('change', function() {
                fetch('/api/posts/checkSlug?title=' + $(this).val())
                    .then(response => response.json())
                    .then(data => $('#slugForm').val(data.slug))
            });
            var content = CKEDITOR.replace('editor');
        })
    </script>
@endsection
