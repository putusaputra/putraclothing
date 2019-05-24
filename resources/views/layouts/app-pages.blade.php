<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/style.css') }}" rel="stylesheet">    
</head>
<body>
    <div id="app">
        @include('inc.navbar2')
        {{--@include('inc.navbar')--}}
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>

        @include('inc.footer')
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type = "text/javascript">
        function getLocalStorageCurrentValue() {
            var count = JSON.parse(localStorage.getItem('items'));
            var itemsCount = count != 'undefined' && count != null ? count.items.length : 0;

            if (itemsCount > 0) {
                $('.nav-item .checkout-link #checkout-count').text(itemsCount);
            } else {
                $('.nav-item .checkout-link #checkout-count').text('');
            }
        }

        $(document).ready(function(){
            getLocalStorageCurrentValue();
        });
    </script>
</body>