<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <title>{{ $title . ' | ' . strip_tags(App\Helpers\AppHelper::instance()->getOptions('site_name')) }}</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body>
    @include('admin.layouts.partials.sidebar')
    <div class="relative ml-64 overflow-x-hidden">
        @include('admin.layouts.partials.header')
        <div class="space-y-8 px-4 py-4">
            <h2 class="text-xl font-medium">{{ $title }}</h2>
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>
