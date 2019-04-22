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
        @include('inc.messages')
        
        <div class="row row--nomargin">
            <div class="title col-lg-12">
                <h1>User Admin Page</h1>
            </div>
            <div class="sidebar col-lg-3 col-md-3 col-xs-12">
                <div class="sidebar__title">Menu</div>
                <ul>
                    <li>Create Orders</li>
                    <li>Show all orders</li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Log Out</a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            <div class="content col-lg-9 col-md-9 col-xs-12">
                @yield('content')
            </div>
        </div>
       
        @include('inc.footer')
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
</body>