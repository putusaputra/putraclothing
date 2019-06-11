@extends(Auth::user()->isAdmin == 1 ? 'layouts.app-admin' : 'layouts.app-useradmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class = "col-lg-6 float-left">List Orders</div>
                    <div class = "col-lg-4 float-right">
                        {!! Form::open(['action' => 'OrdersController@searchOrderByName', 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                {{ Form::text('search_order', '', ['class' => 'form-control', 'placeholder' => 'search by order name']) }}
                            </div>

                            {{ Form::submit('Submit', ['class' => 'btn btn-primary', 'style' => 'display:none;']) }}
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User Name</th>
                                <th>Shipping Address</th>
                                <th>Grandtotal</th>
                                <th>Status</th>
                                <th>Snap Token</th>
                                @if (Auth::user()->isAdmin == 1)
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>

                    @if (count($orders) > 0)
                                
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->user_name }}</td>
                                <td>{{ $order->shipping_address }}</td>
                                <td>{{ $order->grandtotal }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->snap_token }}</td>

                                @if (Auth::user()->isAdmin == 1)
                                    <td>
                                        <a class="btn btn-success" href="javascript:void(0);" data-toggle = "modal" data-target = "#orderModal" id = "show-order-detail" title = "show order details" data-order-id = "{{ $order->order_id }}" data-status = "{{ $order->status }}">
                                            <img src="{{ asset('icons/pencil.svg') }}"/>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                               
                    
                    @else
                        <tr>
                            <td colspan="5">No Orders Found</td>
                        </tr>
                    @endif

                        </tbody>
                    </table>
                    {{ $orders->links() }}
                
                </div>

            </div>
        </div>
    </div>
</div>
@endsection