@extends('layouts.main')
@section('title', 'Contact Form | ' . strip_tags(App\Helpers\AppHelper::instance()->getOptions('site_name')))
@section('content')
    <div class="flex flex-col">
        {{-- Breadcrumbs --}}
        <nav>
            <ul class="flex items-center gap-2 text-xs md:text-sm">
                <li>
                    <a class="capitalize font-medium text-gray-600 hover:text-blue-500 transition duration-300" href="/"
                        title="Home">
                        Home
                    </a>
                </li>
                <li>
                    <svg class="w-[10px] fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path
                            d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                    </svg>
                </li>
                <li>
                    <p class="line-clamp-1 text-gray-500">Contact Form</p>
                </li>
            </ul>
        </nav>
        <div class="space-y-4 mt-8">
            <h1 class="text-xl font-semibold text-blue-500">Contact Form</h1>
            <div>
                <form class="space-y-8" action="/{{ Request::path() }}" method="POST">
                    @csrf
                    <div class="space-y-2">
                        <div class="flex flex-col">
                            <label for="nameForm" class="text-lg font-medium text-slate-500">Name</label>
                            <input
                                class="px-4 py-2 rounded-md bg-slate-200 w-full focus:outline-gray-200 focus:bg-slate-50 focus:shadow-md"
                                type="text" name="name" value="{{ old('name') }}" id="nameForm" required>
                        </div>
                        <div class="flex flex-col">
                            <label for="emailForm" class="text-lg font-medium text-slate-500">Email</label>
                            <input
                                class="px-4 py-2 rounded-md bg-slate-200 w-full focus:outline-gray-200 focus:bg-slate-50 focus:shadow-md"
                                type="email" name="email" value="{{ old('email') }}" id="emailForm" required>
                        </div>
                        <div class="flex flex-col">
                            <label for="subjectForm" class="text-lg font-medium text-slate-500">Subject</label>
                            <input
                                class="px-4 py-2 rounded-md bg-slate-200 w-full focus:outline-gray-200 focus:bg-slate-50 focus:shadow-md"
                                type="text" name="subject" value="{{ old('email') }}" id="subjectForm" required>
                        </div>
                        <div class="flex flex-col">
                            <label for="messageForm" class="text-lg font-medium text-slate-500">Message</label>
                            <textarea class="px-4 py-2 rounded-md bg-slate-200 w-full focus:outline-gray-200 focus:bg-slate-50 focus:shadow-md"
                                name="message" id="messageForm" cols="30" rows="10">{!! old('message') !!}</textarea>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="w-1/2 py-2 bg-blue-500 text-white rounded-xl">Submit</button>
                    </div>
                </form>
            </div>
            <hr>
        </div>
    </div>
    <div id="preview-image" class="hidden">
        <div id="back-image" class="fixed inset-0 bg-black/70 z-[998]">
        </div>
        <div id="preview-image-show" class="fixed inset-0 m-auto w-fit h-fit z-[999]">
        </div>
    </div>
@endsection
