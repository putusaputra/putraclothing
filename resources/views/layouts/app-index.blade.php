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
                var ls = JSON.parse(localStorage.getItem('items'));
                var localStorageCount = ls != 'undefined' && ls != null ? ls.items.length : 0;
                var itemPreview = $(elem).closest('.item__cart').closest('.item').attr('imgpreview');
                var itemCode = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__code').children('.item__value').text();
                var itemCategory = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__category').children('.item__value').text();
                var itemName = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__name').children('.item__value').text();
                var itemMaterial = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__material').children('.item__value').text();
                var itemSize = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__size').children('.item__value').text();
                var itemPrice = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__price').children('.item__value').text();
                var itemQty = $(elem).closest('.item__cart').closest('.item').children('.item__info').children('.item__qty').children('.item__value').find('input[name="item_qty"]').val();

                if (itemQty == 'undefined' || itemQty == null || itemQty == 0) {
                    alert('please add qty!')
                    return;
                }

                var content = {};
                content['itemPreview'] = itemPreview;
                content['itemCode'] = itemCode;
                content['itemCategory'] = itemCategory;
                content['itemName'] = itemName;
                content['itemMaterial'] = itemMaterial;
                content['itemSize'] = itemSize;
                content['itemPrice'] = itemPrice;
                content['itemQty'] = itemQty;

                if (localStorageCount > 0) {
                    data = null;
                    data = ls;
                }
                data['items'].push(content);
                
                localStorage.setItem('items', JSON.stringify(data));
                var count = JSON.parse(localStorage.getItem('items'));
                var itemsCount = count.items.length;

                $('.nav-item .checkout-link #checkout-count').text(itemsCount);

                alert(itemName + " added to cart!");

            } else {
                alert("Your browser doesn't support web storage!");
            }
        }

        function getLocalStorageCurrentValue() {
            var count = JSON.parse(localStorage.getItem('items'));
            var itemsCount = count != 'undefined' && count != null ? count.items.length : 0;

            if (itemsCount > 0) {
                $('.nav-item .checkout-link #checkout-count').text(itemsCount);
            } else {
                $('.nav-item .checkout-link #checkout-count').text('');
            }
        }

        function getCheckoutContent() {
            var checkoutPageCode = $('#checkout-page-code').text() != 'undefined' && $('#checkout-page-code').text() != null && $('#checkout-page-code').text() != '' ? $('#checkout-page-code').text() : null;
            var ajaxData = JSON.parse(localStorage.getItem('items'));

            if (checkoutPageCode != null && ajaxData != 'undefined') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/checkout-content',
                    type: 'POST',
                    data: {items : JSON.stringify(ajaxData)},
                    success: function (result) {
                        $('#checkout-content-wrapper').html(result);
                        $('.item__link--popup').magnificPopup({type:'image'});
                    },
                    error: function (xhr) {
                        alert('error ' + xhr.status + ' ' + xhr.statusText);
                    } 
                });
            }
        }

        $(document).ready(function(){
            getLocalStorageCurrentValue();
            getCheckoutContent();
            $('.item__link--popup').magnificPopup({type:'image'});
            $('.item__cart__a').on('click', function(){
                addItemToCart($(this));
            });
        });
    </script>
</body>