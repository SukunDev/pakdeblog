<footer class="border-t border-gray-200">
    <div class="container mx-auto my-4">
        <nav class="flex flex-col space-y-6">
            <ul class="flex flex-wrap items-center justify-center gap-4">
                @foreach (json_decode(AppHelper::instance()->getOptions('footer_menu'), true) as $name => $value)
                    <li class="capitalize py-2 hover:text-gray-400 transition duration-300"><a href="{{ $value }}"
                            title="{{ $name }}">{{ $name }}</a></li>
                @endforeach
            </ul>
            <div class="text-center">
                <p class="text-sm">Copyright &copy; 2022 <a class="hover:text-blue-500 transition duration-300"
                        href="/">{!! AppHelper::instance()->getOptions('site_name') !!}</a> All Right Reserved</p>
            </div>
        </nav>
    </div>
</footer>
