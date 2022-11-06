<div class="relative px-4 py-4 rounded-md bg-blue-500 shadow-md border border-gray-200 text-white capitalize">
    <p class="text-5xl">{{ $value }}</p>
    <p class="font-medium">{{ $name }}</p>
    <div class="absolute -rotate-12 -bottom-6 -right-6 text-white/25">
        {{ $slot }}
    </div>
</div>
