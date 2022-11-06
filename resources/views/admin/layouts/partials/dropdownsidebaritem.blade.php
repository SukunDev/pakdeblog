<button
    class="dropdown-button w-full flex items-center justify-between px-4 py-2 rounded-md text-white capitalize transition duration-300 text-lg {{ Request::is($path . '*') ? 'bg-black/[0.15] font-medium text-gray-200' : 'hover:bg-black/[0.10] hover:text-gray-200' }}">
    <span class="flex items-center gap-4">
        {{ $slot }}
        {{ $name }}
    </span>
    <svg id="dropdownArrow" class="w-3 fill-current {{ Request::is($path . '*') ? 'flip' : '' }}"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
        <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
        <path
            d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z" />
    </svg>
</button>
<ul class="dropdown-item" style="display: {{ Request::is($path . '*') ? 'block' : 'none' }}">
    @foreach ($dropdowns as $item)
        <li>
            <a class="block pl-[3.2rem] pr-4 py-2 rounded-md text-white capitalize transition duration-300 {{ Request::is($item['href']) ? 'bg-black/[0.15] font-medium text-gray-200' : 'hover:bg-black/[0.10] hover:text-gray-200' }}"
                href="/{{ $item['href'] }}">
                {{ $item['name'] }}
            </a>
        </li>
    @endforeach
</ul>
