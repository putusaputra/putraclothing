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
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('inc.navbar2')
        {{--@include('inc.navbar')--}}
        @include('inc.messages')
        @yield('content')
        @include('inc.footer')
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript">
        var data = {};
        data['items'] = [];

        function checkWebStorageAvailability() {
            if (typeof(Storage) !== "undefined") {
                return true;
            } else {
                return false;
            }
        }

        function addItemToCart(elem) {
            if (checkWebStorageAvailability()) {
                var itemsCount = localStorage.getItem('itemsCount') != "undefined" ? localStorage.getItem('itemsCount') : 0;
                var itemCode = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__code').children('.item__value').text();
                var itemCategory = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__category').children('.item__value').text();
                var itemName = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__name').children('.item__value').text();
                var itemMaterial = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__material').children('.item__value').text();
                var itemSize = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__size').children('.item__value').text();
                var itemPrice = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__price').children('.item__value').text();
                var itemQty = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__qty').children('.item__value').find('input[name="item_qty"]').val();
                alert(itemCode + "\n" + itemCategory + "\n" + itemName + "\n" + itemMaterial + "\n" + itemSize + "\n" + itemPrice + "\n" + itemQty);

                var content = {};
                content['itemCode'] = itemCode;
                content['itemCategory'] = itemCategory;
                content['itemName'] = itemName;
                content['itemMaterial'] = itemMaterial;
                content['itemSize'] = itemSize;
                content['itemPrice'] = itemPrice;
                content['itemQty'] = itemQty;
                data['items'].push(content);

                localStorage.setItem('items', JSON.stringify(data));
                //console.log(JSON.parse(localStorage.getItem('items')));

            } else {
                alert("Your browser doesn't support web storage!");
            }
        }

        $(document).ready(function(){
            $('.item__link--popup').magnificPopup({type:'image'});
            $('.item__cart').on('click', function(){
                addItemToCart($(this));
            });
        });
    </script>
</body>