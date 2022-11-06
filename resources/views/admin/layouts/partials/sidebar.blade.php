<div id="sidebar" class="fixed inset-y-0 w-64 bg-slate-700 text-white shadow-md z-[100]">
    <div class="sticky w-full bg-black/[0.15]">
        <div class="flex items-center gap-4 px-4 py-4">
            <img class="h-9" src="{{ App\Helpers\AppHelper::instance()->getOptions('logo_url') }}"
                alt="Logo {{ strip_tags(App\Helpers\AppHelper::instance()->getOptions('site_name')) }}" loading="lazy">
            <h1 class="text-xl">{!! App\Helpers\AppHelper::instance()->getOptions('site_name') !!}</h1>
        </div>
    </div>
    <ul>
        <li>
            @component('admin.layouts.partials.itemsidebar', ['name' => 'dashboard', 'href' => 'admin'])
                <svg class="w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                </svg>
            @endcomponent
        </li>
        <li class="relative">
            @component('admin.layouts.partials.dropdownsidebaritem',
                [
                    'name' => 'posts',
                    'path' => 'admin/posts',
                    'dropdowns' => [
                        ['name' => 'semua article', 'href' => 'admin/posts'],
                        ['name' => 'tulis article', 'href' => 'admin/posts/new'],
                        ['name' => 'kategori', 'href' => 'admin/posts/category'],
                        ['name' => 'tags', 'href' => 'admin/posts/tags'],
                    ],
                ])
                <svg class="w-4 mr-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
                </svg>
            @endcomponent
        </li>
    </ul>
</div>
