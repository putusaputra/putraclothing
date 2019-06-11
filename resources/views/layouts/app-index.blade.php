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
        @include('inc.messages')
        @yield('content')
        @include('inc.footer')
        @include('inc.checkout-modal')
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Midtrans script -->
    <script type = "text/javascript" src = "{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key = "{{ config('services.midtrans.clientKey') }}"></script>
    <script type="text/javascript">
        var data = {};
        data['items'] = [];
        var gross_amount = 0;
        var item_details;

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

                if (itemQty == 'undefined' || itemQty == null || itemQty == 0 || isNaN(itemQty)) {
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
                        gross_amount = $('#checkout-transfer').data('grossamount');
                        item_details = $('#checkout-transfer').data('itemdetails');
                        $('.item__link--popup').magnificPopup({type:'image'});

                        $('#checkoutModal #proceed-to-payment').on('click', function(){
                            var form = $('#formCheckoutModal')[0];
                            if (form.checkValidity()) {
                                $('#formCheckoutModal').submit();
                            } else {
                                form.reportValidity();
                            }
                        });

                        $('#formCheckoutModal').on('submit', function(event){
                            event.preventDefault();
                            getSnapToken();
                        });
                    },
                    error: function (xhr) {
                        alert('error ' + xhr.status + ' ' + xhr.statusText);
                    } 
                });
            }
        }

        function getSnapToken() {
            var address = $('#checkoutModal #address').val();
            var city = $('#checkoutModal #city').val();
            var phone = $('#checkoutModal #phone').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('checkout.store') }}",
                type: 'POST',
                data: {gross_amount:gross_amount, item_details:item_details, address:address, city:city, phone:phone},
                success: function(result) {
                    console.log(result);
                    snap.pay(result.snap_token);
                },
                error: function(xhr) {
                    alert('error: ' + xhr.status + "-" + xhr.statusText);
                }
            });
        }

        $(document).ready(function() {
            getLocalStorageCurrentValue();
            getCheckoutContent();
            $('.item__link--popup').magnificPopup({type:'image'});
            $('.item__cart__a').on('click', function(){
                addItemToCart($(this));
            });

            $(document).on('show.bs.modal', '#checkoutModal', function() {
                $('#formCheckoutModal').trigger('reset');
            });
        });
    </script>
</body>