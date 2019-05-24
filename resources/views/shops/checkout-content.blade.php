<div class = "table-responsive">
    <table class = "table table-bordered">
        <thead class = "thead-dark">
            <tr>
                <th>Item Code</th>
                <th>Item Category</th>
                <th>Item Name</th>
                <th>Item Preview</th>
                <th>Item Material</th>
                <th>Item Size</th>
                <th>Item Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

@if (count($items) > 0)

    @php
        $total = 0;
        $grandTotal = 0;
    @endphp

        @foreach ($items['items'] as $item)

            <tr>
                <td>{{ $item['itemCode'] }}</td>
                <td>{{ $item['itemCategory'] }}</td>
                <td>{{ $item['itemName'] }}</td>
                <td>
                    <a class = "item__link--popup" href = "/storage/t-shirts/{{ $item['itemPreview'] }}">
                        <img class = "item__img item__img--minified" src = "/storage/t-shirts/{{ $item['itemPreview'] }}" />
                    </a>
                </td>
                <td>{{ $item['itemMaterial'] }}</td>
                <td>{{ $item['itemSize'] }}</td>
                <td>{{ number_format($item['itemPrice'], 0, ",", ".") }}</td>
                <td>{{ $item['itemQty'] }}</td>
                <td>{{ number_format($item['itemQty'] * $item['itemPrice'], 0, ",", ".") }}</td>
            </tr>

            @php
                $total = $item['itemQty'] * $item['itemPrice'];
                $grandTotal = $grandTotal + $total;
            @endphp

        @endforeach

            <tr>
                <td class = "text-right" colspan = "7">Grand Total</td>
                <td>{{ number_format($grandTotal, 0, ",", ".") }}</td>
                <td>
                    <a class = "btn btn-block btn-primary btn-lg" href = "javascript:void(0);">Checkout</a>
                </td>
            </tr>

        </tbody>
    </table>
</div>

@else
    <h1>No Data</h1>
@endif