<header class="sticky inset-x-0 top-0 bg-white shadow-md z-50">
    <div class="flex items-center justify-between px-4 py-4">
        <div>
            <button id="sticky-header-menu-button" class="block sm:hidden">
                <svg class="w-5 fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                </svg>
            </button>
            <form class="hidden sm:block" method="GET">
                <div class="flex items-center">
                    <button type="submit" class="px-2 py-2 rounded-l-md bg-sky-100">
                        <svg class="w-6 fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                        </svg>
                    </button>
                    <input
                        class="search-form px-4 md:w-auto lg:w-[25vw] py-2 rounded-r-md bg-sky-100 focus:outline-none focus:ring-sky-200 focus:ring-2 transition duration-300 placeholder:text-gray-400 placeholder:font-light"
                        type="text" name="search" value="{{ request('search') }}" placeholder="Search...">
                </div>
            </form>
        </div>
        <button id="profile-button">
            <img class="h-9" src="/image/user-profile.png" alt="Photo Profile">
        </button>
    </div>
    <div id="profile-panel" class="absolute top-[4.5rem] right-0" style="display: none">
        <div class="bg-white shadow-md border border-gray-200 space-y-2">
            <div class="px-4 pt-4 space-y-0.5">
                <p class="font-medium">{{ Auth::user()->username }}</p>
                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
            </div>
            <hr>
            <form action="/auth/logout" method="POST">
                @csrf
                <button
                    class="w-full px-4 py-2 rounded-md hover:bg-gray-200 hover:text-gray-500 active:text-gray-700 active:bg-gray-100 transition duration-300"
                    type="submit">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M534.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L434.7 224 224 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM192 96c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-53 0-96 43-96 96l0 256c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                        </svg>
                        Logout
                    </span>
                </button>
            </form>
        </div>
    </div>
</header>
