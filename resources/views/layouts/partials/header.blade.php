<header class="fixed inset-x-0 bg-white shadow-md z-[100]">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <a class="flex items-center gap-2" href="/"
                title="{{ strip_tags(App\Helpers\AppHelper::instance()->getOptions('site_name')) }}">
                <img class="h-9" src="{{ App\Helpers\AppHelper::instance()->getOptions('logo_url') }}"
                    alt="Logo {{ strip_tags(App\Helpers\AppHelper::instance()->getOptions('site_name')) }}"
                    loading="lazy">
                @if (Request::is('/'))
                    <h1 class="text-xl">{!! App\Helpers\AppHelper::instance()->getOptions('site_name') !!}</h1>
                @else
                    <p class="text-xl">{!! App\Helpers\AppHelper::instance()->getOptions('site_name') !!}</p>
                @endif
            </a>
            <div class="relative flex items-center gap-4">
                <nav id="primary-nav"
                    class="hidden sm:block fixed sm:relative inset-x-0 sm:inset-x-auto top-[4.25rem] sm:top-auto bg-white sm:bg-transparent shadow-md sm:shadow-none z-50">
                    <ul class="flex flex-col sm:flex-row items-end sm:items-center px-4 sm:px-0 gap-4">
                        @foreach (json_decode(AppHelper::instance()->getOptions('header_menu'), true) as $name => $value)
                            <li
                                class="flex sm:block items-center sm:items-start gap-2 sm:gap-0 capitalize py-2 hover:text-gray-400 transition duration-300">
                                <a href="{{ $value }}" title="{{ $name }}">{{ $name }}</a>
                                <svg class="block sm:hidden w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path
                                        d="M181.3 32.4c17.4 2.9 29.2 19.4 26.3 36.8L197.8 128h95.1l11.5-69.3c2.9-17.4 19.4-29.2 36.8-26.3s29.2 19.4 26.3 36.8L357.8 128H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H347.1L325.8 320H384c17.7 0 32 14.3 32 32s-14.3 32-32 32H315.1l-11.5 69.3c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8l9.8-58.7H155.1l-11.5 69.3c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8L90.2 384H32c-17.7 0-32-14.3-32-32s14.3-32 32-32h68.9l21.3-128H64c-17.7 0-32-14.3-32-32s14.3-32 32-32h68.9l11.5-69.3c2.9-17.4 19.4-29.2 36.8-26.3zM187.1 192L165.8 320h95.1l21.3-128H187.1z" />
                                </svg>
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <button id="search-button" aria-label="Search Button">
                    <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path
                            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z" />
                    </svg>
                </button><button id="primary-nav-button" class="block sm:hidden" aria-label="Search Menu">
                    <svg class="w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path
                            d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                    </svg>
                </button>
                <div id="search-item"
                    class="fixed md:absolute top-[4.5rem] md:top-[3.8rem] inset-x-0 md:inset-x-auto md:right-0 hidden">
                    <div class="container mx-auto md:w-96 px-4 rounded-md">
                        <form class="w-full" action="/" method="GET">
                            <input
                                class="w-full px-4 py-2 bg-slate-200 focus:outline-none focus:bg-white focus:shadow-md rounded-lg"
                                placeholder="Search" type="text" name="search" id="search"
                                itemprop="query-input">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
