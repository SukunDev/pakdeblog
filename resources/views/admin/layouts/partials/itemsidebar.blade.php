<a class="block capitalize px-4 py-2 text-lg {{ Request::is($href) ? 'bg-black/[0.10]' : 'hover:bg-black/[0.10] hover:text-gray-200' }} transition duration-300"
    href="/{{ $href }}">
    <span class="flex items-center gap-4">
        {{ $slot }}
        {{ $name }}
    </span>
</a>
