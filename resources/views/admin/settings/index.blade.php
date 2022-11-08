@extends('admin.layouts.main')
@section('content')
    <div class="px-4 py-4 rounded-md bg-white shadow-md border border-gray-200">
        <form class="space-y-4" action="/{{ Request::path() }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col">
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="siteTitleForm">nama situs</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="text" name="site_name" id="siteTitleForm" value="{{ $settings['site_name'] }}" required>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="deskripsiForm">deskripsi</label>
                    <textarea id="deskripsiForm" rows="3"
                        class="px-4 py-2 rounded-md bg-gray-100 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        placeholder="Diskripsi situs" name="description" required>{{ $settings['description'] }}</textarea>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="keywordForm">keyword</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="text" name="keyword" id="keywordForm" value="{{ $settings['keyword'] }}" required>
                </div>
            </div>
            <div class="w-full sm:w-2/3 lg:w-1/2 flex flex-col space-y-1">
                <p class="capitalize font-medium">logo</p>
                <label
                    class="aspect-w-16 aspect-h-10 border-2 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300">
                    <div
                        class="tempatGambar absolute inset-0 m-auto h-fit w-fit {{ $settings['logo_url'] ? 'hidden' : '' }}">
                        <div class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                Attach a file</p>
                        </div>
                    </div>
                    <img class="output w-full object-contain absolute inset-0 m-auto {{ $settings['logo_url'] ? '' : 'hidden' }}"
                        src="{{ $settings['logo_url'] }}" />
                    <input type="file" class="opacity-0" name="logo_file" onchange="loadFile(event,this)" />
                </label>
            </div>
            <div class="flex flex-col">
                <p class="capitalize font-medium">favicon</p>
                <div class="flex items-center gap-4">
                    <img src="/favicon.ico" alt="">
                    <div class="flex flex-col w-full">
                        <label class="block">
                            <span class="sr-only">Choose File</span>
                            <input type="file"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-800 file:text-white hover:file:bg-slate-700"
                                name="favicon_file" id="faviconForm" />
                        </label>
                        <p class="text-xs text-gray-500">hanya support file favicon ( ico )</p>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <p class="text-xl capitalize font-medium">site verification</p>
                <div class="space-y-4">
                    <div class="flex flex-col">
                        <div class="flex flex-col">
                            <label class="capitalize font-medium" for="googleVerificationCodeForm">google verification
                                code</label>
                            <input
                                class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                                type="text" name="google_verification_code" id="googleVerificationCodeForm"
                                value="{{ $settings['google_verification_code'] }}">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex flex-col">
                            <label class="capitalize font-medium" for="yandexVerificationCodeForm">yandex verification
                                code</label>
                            <input
                                class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                                type="text" name="yandex_verification_code" id="yandexVerificationCodeForm"
                                value="{{ $settings['yandex_verification_code'] }}">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex flex-col">
                            <label class="capitalize font-medium" for="bingVerificationCodeForm">bing verification
                                code</label>
                            <input
                                class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                                type="text" name="bing_verification_code" id="bingVerificationCodeForm"
                                value="{{ $settings['bing_verification_code'] }}">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex flex-col">
                            <label class="capitalize font-medium" for="baiduVerificationCodeForm">baidu verification
                                code</label>
                            <input
                                class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                                type="text" name="baidu_verification_code" id="baiduVerificationCodeForm"
                                value="{{ $settings['baidu_verification_code'] }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <p class="text-xl capitalize font-medium">Insert Code</p>
                <div class="space-y-4">
                    <div class="flex flex-col">
                        <div class="flex flex-col">
                            <label class="capitalize font-medium" for="headCodeForm">Head Code</label>
                            <textarea id="headCodeForm" rows="6"
                                class="px-4 py-2 rounded-md bg-gray-100 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                                placeholder="tempel kode yang ingin anda sematkan" name="header_insert_code">{{ $settings['header_insert_code'] }}</textarea>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex flex-col">
                            <label class="capitalize font-medium" for="sidebarCodeForm">sidebar Code</label>
                            <textarea id="sidebarCodeForm" rows="6"
                                class="px-4 py-2 rounded-md bg-gray-100 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                                placeholder="tempel kode yang ingin anda sematkan" name="sidebar_insert_code">{{ $settings['sidebar_insert_code'] }}</textarea>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex flex-col">
                            <label class="capitalize font-medium" for="footerCodeForm">footer Code</label>
                            <textarea id="footerCodeForm" rows="6"
                                class="px-4 py-2 rounded-md bg-gray-100 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                                placeholder="tempel kode yang ingin anda sematkan" name="footer_insert_code">{{ $settings['footer_insert_code'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-start">
                <button
                    class="px-8 py-2 capitalize text-lg rounded-md bg-green-500 hover:bg-green-600 active:bg-green-500 transition duration-300 text-white"
                    type="submit">simpan</button>
            </div>
        </form>
        <script type="text/javascript">
            $(document).on("keydown", ":input:not(textarea):not(:submit)", function(event) {
                return event.key != "Enter";
            });
            var loadFile = function(event, elem) {
                var reader = new FileReader();
                var tempatGambar = $(elem).parent().find('.tempatGambar');
                reader.onload = function() {
                    var output = $(elem).parent().find('.output');
                    output.attr('src', reader.result)
                };
                $(elem).parent().find('.output').show()
                tempatGambar.hide()
                reader.readAsDataURL(event.target.files[0]);
            };
        </script>
    </div>
@endsection
