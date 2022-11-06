<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>{{ strip_tags(App\Helpers\AppHelper::instance()->getOptions('site_name')) }} | Sign In</title>
</head>

<body class="bg-gray-800">
    <main class="fixed inset-0 m-auto w-full sm:w-1/2 lg:w-1/3 h-fit">
        <div class="rounded-lg bg-white px-4 py-8 space-y-4  text-gray-700">
            <h1 class="text-2xl">{!! App\Helpers\AppHelper::instance()->getOptions('site_name') !!}</h1>
            <div>
                <p class="text-xl font-medium text-gray-600">Sign In</p>
                <p class="text-gray-500">Access the dashboard using your username and password.</p>
            </div>
            <form class="mt-4 space-y-4" action="/{{ Request::path() }}" method="POST">
                @csrf
                <div class="flex flex-col">
                    <label class="font-medium" for="emailForm">Email</label>
                    <input type="text" name="email" id="emailForm"
                        class="px-4 py-2 rounded-md bg-slate-200 focus:outline-slate-200 focus:shadow-md focus:bg-white transition duration-300 text-sm">
                </div>
                <div class="flex flex-col">
                    <label class="font-medium" for="password">Password</label>
                    <input type="password" name="password" id="password"
                        class="px-4 py-2 rounded-md bg-slate-200 focus:outline-slate-200 focus:shadow-md focus:bg-white transition duration-300 text-sm">
                </div>
                <div class="flex justify-center">
                    <div class="flex flex-col">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                        </div>
                        @error('g-recaptcha-response')
                            <p class="text-red-500 text-center">selesaikan google recaptcha</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-center">
                    <button
                        class="w-full py-1.5 rounded-lg bg-yellow-500 hover:bg-yellow-600 active:bg-yellow-500 transition duration-300 text-white text-lg font-medium"
                        type="submit">Sign In</button>
                </div>
            </form>
        </div>
        @include('layouts.partials.alert')
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('#alert').each(function() {
                $(this).find('button').on("click", function() {
                    $(this).parent().remove();
                });
            });
        });
    </script>
</body>

</html>
