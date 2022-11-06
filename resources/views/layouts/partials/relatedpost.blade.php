@if ($related_post->count() > 0)
    <div
        class="text-lg font-semibold text-gray-600 after:flex after:bg-blue-500 after:my-0.5 after:h-1 after:w-24 after:rounded-md">
        <p>Related Post</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        @foreach ($related_post as $post)
            <article>
                <div class="relative group">
                    <a href="/{{ $post->slug }}" class="block aspect-w-16 aspect-h-9">
                        <img class="w-full rounded-t-md object-cover"
                            src="{{ $post->thumbnail ? $post->thumbnail : '/image/no-image.png' }}"
                            alt="{{ $post->title }}." loading="lazy">
                        <span
                            class="absolute inset-0 bg-black/[.20] rounded-t-md group-hover:bg-black/0 transition duration-300"></span>
                    </a>
                    <a href="/category/{{ $post->category->slug }}"
                        class="absolute -bottom-2.5 pl-6 pr-8 py-1 rounded-r-full text-white bg-blue-500 hover:bg-blue-400 transition duration-300 text-sm sm:text-xs capitalize"
                        title="{{ $post->category->name }}">
                        {{ $post->category->name }}
                    </a>
                </div>
                <div class="mt-6">
                    <h2
                        class="text-lg sm:text-base font-semibold transition duration-300 hover:text-slate-400 line-clamp-2 sm:line-clamp-1">
                        <a href="/{{ $post->slug }}" title="{{ $post->title }}">{{ $post->title }}
                        </a>
                    </h2>
                    <div class="flex sm:hidden items-center my-2 gap-8 text-xs font-medium text-gray-500">
                        <span class="flex items-center gap-1">
                            <svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M232 120C232 106.7 242.7 96 256 96C269.3 96 280 106.7 280 120V243.2L365.3 300C376.3 307.4 379.3 322.3 371.1 333.3C364.6 344.3 349.7 347.3 338.7 339.1L242.7 275.1C236 271.5 232 264 232 255.1L232 120zM256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0zM48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256z" />
                            </svg>
                            {{ Carbon\Carbon::parse($post->published_at)->format('d, M Y') }}
                        </span>
                        <a href="/author/{{ $post->user->username }}"
                            class="flex items-center gap-1 hover:text-blue-500 transition duration-300"
                            title="{{ $post->user->name }}">
                            <svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path
                                    d="M421.7 220.3l-11.3 11.3-22.6 22.6-205 205c-6.6 6.6-14.8 11.5-23.8 14.1L30.8 511c-8.4 2.5-17.5 .2-23.7-6.1S-1.5 489.7 1 481.2L38.7 353.1c2.6-9 7.5-17.2 14.1-23.8l205-205 22.6-22.6 11.3-11.3 33.9 33.9 62.1 62.1 33.9 33.9zM96 353.9l-9.3 9.3c-.9 .9-1.6 2.1-2 3.4l-25.3 86 86-25.3c1.3-.4 2.5-1.1 3.4-2l9.3-9.3H112c-8.8 0-16-7.2-16-16V353.9zM453.3 19.3l39.4 39.4c25 25 25 65.5 0 90.5l-14.5 14.5-22.6 22.6-11.3 11.3-33.9-33.9-62.1-62.1L314.3 67.7l11.3-11.3 22.6-22.6 14.5-14.5c25-25 65.5-25 90.5 0z" />
                            </svg>
                            {{ $post->user->name }}
                        </a>
                    </div>
                    <div class="block sm:hidden my-4 line-clamp-3 text-sm md:text-base text-gray-600">
                        <p>{{ $post->excerpt }}</p>
                    </div>
                    <a class="flex sm:hidden items-center gap-2 capitalize w-fit px-4 py-1.5 rounded-full border-2 border-transparent hover:border-blue-400 hover:text-blue-500 transition duration-300 text-sm"
                        href="/{{ $post->slug }}" title="{{ $post->title }}">
                        read more
                        <svg class="w-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" />
                        </svg>
                    </a>
                </div>
            </article>
        @endforeach
    </div>

@endif
