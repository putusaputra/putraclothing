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
        
        <div class="row row--nomargin">
            <div class="title col-lg-12">
                <h1>Internal Admin Page</h1>
            </div>
            <div class="sidebar col-lg-3 col-md-3 col-xs-12">
                <div class="sidebar__title">Menu</div>
                <ul>
                    <li><a href = "/items/create">Create Item</a></li>
                    <li><a href = "/items">Show all items</a></li>
                    <li><a href = "/orders">Show all orders</a></li>
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
        @include('inc.order-modal')
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript">
        function getLocalStorageCurrentValue() {
            var count = JSON.parse(localStorage.getItem('items'));
            var itemsCount = count != 'undefined' && count != null ? count.items.length : 0;

            if (itemsCount > 0) {
                $('.nav-item .checkout-link #checkout-count').text(itemsCount);
            } else {
                $('.nav-item .checkout-link #checkout-count').text('');
            }
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-create').attr('src', e.target.result);
                    $('#a-create').attr('href', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // admin orders page
        function getOrderDetails(ev) {
            var rt = $(ev.relatedTarget);
            var order_id = rt.data('order-id');
            var status = rt.data('status');
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('orderdetails.index') }}",
                type: 'POST',
                data: {order_id: order_id},
                success: function(data) {
                    $('#orderModalWrapper').html(data);
                    $("select#orderStatus option[value='"+ status +"']").prop('selected', true);
                },
                error: function(xhr) {
                    console.log(xhr.status + "-" + xhr.statusText);
                }
            });
        }

        function updateOrderStatus(el) {
            var elModalBody = $(el).closest('.modal-content').find('.modal-body');
            var order_id = elModalBody.find('#orderModalWrapper').find('table tbody').find('tr td:nth-child(1)').text();
            var status = elModalBody.find('select#orderStatus option:selected').val();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/orders/'+ order_id,
                type: 'PUT',
                data: {status:status},
                success: function(data) {
                    if (data == "true") {
                        alert('Status of Order ID : ' + order_id + " is successfully updated to " + status);
                        location.reload();
                    } else {
                        alert('Status of Order ID : ' + order_id + " is fail to updated to " + status);
                    }
                    
                },
                error: function(xhr) {
                    console.log(xhr.status + "-" + xhr.statusText);
                }
            });
        }

        $(document).ready(function(){
            getLocalStorageCurrentValue();
            $('.item__link--popup').magnificPopup({type:'image'});
            $('#item_preview').change(function(){
                $('.item__link--switch').css('display','block');
                readURL(this);
            });

            $(document).on('show.bs.modal', '#orderModal', function(e) {
                $('#orderModalWrapper').html('');
                $('#formOrderModal').trigger('reset');
                getOrderDetails(e);
            });
        });
    </script>
</body>