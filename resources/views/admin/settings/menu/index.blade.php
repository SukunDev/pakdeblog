@extends('admin.layouts.main')
@section('content')
    <div class="px-4 py-4 rounded-md bg-white shadow-md border border-gray-200">
        <form id="sendDataMenu" method="POST" action="/{{ Request::path() }}">
            @csrf
        </form>
        <ul class="flex items-center">
            <li data-panel-id="headerPanel"
                class="nav-menu capitalize px-4 py-2 cursor-pointer font-medium text-gray-700 after:flex after:w-full after:py-[1.5px] after:rounded-full after:bg-blue-400 after:transition-all after:duration-300">
                header menu</li>
            <li data-panel-id="footerPanel"
                class="nav-menu capitalize px-4 py-2 cursor-pointer text-gray-500 hover:text-gray-700 transition duration-300 after:flex after:w-0 after:hover:w-full after:py-[1.5px] after:rounded-full after:bg-blue-400 after:transition-all after:duration-300">
                footer menu</li>
        </ul>
        <div id="headerPanel" style="display: block">
            <p class="text-xl font-medium capitalize px-4 py-4">header menu</p>
            @component('admin.layouts.partials.menuitem', ['items' => $settings['header_menu'], 'name' => 'header_menu'])
            @endcomponent
        </div>
        <div id="footerPanel" style="display: none">
            <p class="text-xl font-medium capitalize px-4 py-4">footer menu</p>
            @component('admin.layouts.partials.menuitem', ['items' => $settings['footer_menu'], 'name' => 'footer_menu'])
            @endcomponent
        </div>
        <script>
            $(document).ready(function() {
                $('.nav-menu').on('click', function() {
                    var menu = $(this)
                    var navMenu = $('.nav-menu');
                    for (var i = 0; i < navMenu.length; i++) {
                        $(navMenu[i]).removeClass(
                            'font-medium text-gray-700 after:flex after:w-full after:py-[1.5px] after:rounded-full after:bg-blue-400 after:transition-all after:duration-300'
                        )
                        $(navMenu[i]).addClass(
                            'text-gray-500 hover:text-gray-700 transition duration-300 after:flex after:w-0 after:hover:w-full after:py-[1.5px] after:rounded-full after:bg-blue-400 after:transition-all after:duration-300'
                        )
                        $('#' + $(navMenu[i]).attr('data-panel-id')).hide()
                    }
                    menu.removeClass(
                        'text-gray-500 hover:text-gray-700 transition duration-300 after:flex after:w-0 after:hover:w-full after:py-[1.5px] after:rounded-full after:bg-blue-400 after:transition-all after:duration-300'
                    )
                    menu.addClass(
                        'font-medium text-gray-700 after:flex after:w-full after:py-[1.5px] after:rounded-full after:bg-blue-400 after:transition-all after:duration-300'
                    )
                    $('#' + menu.attr('data-panel-id')).show()
                })
            })
        </script>
        <script>
            function addElement(elem, name) {
                var parentElem = elem.parentElement.parentElement
                elem.parentElement.remove()
                $('<td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><input class="w-full px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300" type="text" name="name" id="nameForm"></td>')
                    .appendTo(parentElem);
                $('<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><input class="w-full px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300" type="text" name="link" id="linkForm"></td>')
                    .appendTo(parentElem);
                $('<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><button onclick="sendMenu(this,\'' + name +
                        '\')" class="px-4 py-2 rounded-md bg-green-500 hover:bg-green-600 active:bg-green-500 transition duration-300 text-white capitalize">kirim</button></td>'
                    )
                    .appendTo(parentElem);
            }

            function sendMenu(elem, name) {
                var items = []
                if (name == "header_menu") {
                    items = {!! json_encode($settings['header_menu']) !!}
                }
                if (name == "footer_menu") {
                    items = {!! json_encode($settings['footer_menu']) !!}
                }

                var parentTable = $(elem).parent().parent()
                var nameForm = parentTable.find('#nameForm').val()
                var linkForm = parentTable.find('#linkForm').val()
                if (nameForm.length < 1 || linkForm.length < 1) {
                    return
                }
                if (/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(linkForm)) {
                    items[nameForm] = linkForm
                    $("#sendDataMenu").empty();
                    $.each(items, function(key, value) {
                        $('<input type="hidden" name="' + name + '[' + key + ']" value="' + value +
                                '">')
                            .appendTo('#sendDataMenu');
                    })
                    $('<input type="hidden" name="_token" value="{{ csrf_token() }}">').appendTo('#sendDataMenu');
                    $("#sendDataMenu").submit();
                } else {
                    alert('link yang anda masukkan tidak valid')
                }
            }

            function hapusMenu(elem, name) {
                var parentTable = $(elem).parent().parent()
                if (name == "header_menu") {
                    items = {!! json_encode($settings['header_menu']) !!}
                }
                if (name == "footer_menu") {
                    items = {!! json_encode($settings['footer_menu']) !!}
                }
                delete items[$(elem).attr('data-name')]
                $("#sendDataMenu").empty();
                $.each(items, function(key, value) {
                    $('<input type="hidden" name="' + name + '[' + key + ']" value="' + value +
                            '">')
                        .appendTo('#sendDataMenu');
                })
                $('<input type="hidden" name="_token" value="{{ csrf_token() }}">').appendTo('#sendDataMenu');
                $("#sendDataMenu").submit();
            }
        </script>
    </div>
@endsection
