<table class="table table-responsive">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Item Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>

        @if (count($orderdets) > 0)

        @foreach ($orderdets as $orderdet)
        <tr>
            <td>{{ $orderdet->order_id }}</td>
            <td>{{ $orderdet->item_name }}</td>
            <td>{{ $orderdet->qty }}</td>
            <td>{{ $orderdet->price }}</td>
            <td>{{ $orderdet->total }}</td>
        </tr>
        @endforeach

        @else
        <tr>
            <td colspan="5">No Order Details Found</td>
        </tr>
        @endif

    </tbody>
</table>