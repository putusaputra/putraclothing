<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::join('users', 'orders.user_id', 'users.id')
                ->paginate(10);

        return view('internal-admin.list-order')->with('orders', $orders);
    }

    /**
     * Display search result of order by name
     *
     * @return \Illuminate\Http\Response
     */
    public function searchOrderByName(Request $request)
    {
        $keywords = $request->input('search_order');
        $orders = Order::join('users', 'orders.user_id', 'users.id')
                ->where('orders.order_id', 'like', '%' . $keywords . '%')
                ->orWhere('users.name', 'like', '%' . $keywords . '%')
                ->orWhere('orders.shipping_address', 'like', '%' . $keywords . '%')
                ->orWhere('orders.status', 'like', '%' . $keywords . '%')
                ->paginate(10);
        $orders->appends(['search_order' => $keywords]);
        
        return view('internal-admin.list-order')->with('orders', $orders);
    }

    /**
     * Display order details by order id
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrderDetails(Request $request) {
        $order_id = $request->input('order_id');
        $orderdets = OrderDetail::join('items', 'order_details.item_code', 'items.item_code')
                    ->where('order_details.order_id', $order_id)
                    ->get();

        return view('internal-admin.list-order-detail')->with('orderdets', $orderdets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = Order::find($id);
        return view('internal-admin.list-detail-order')->with('orders', $orders);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = $request->input('status');
        $order = Order::find($id);
        $order->status = $status;
        if ($order->save()) {
            return "true";
        } else {
            return "false";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
