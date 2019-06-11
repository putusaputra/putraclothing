<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;
use App\Order;
use App\OrderDetail;

// midtrans library
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
//use Veritrans_Transaction;

class ShopsController extends Controller
{
    /**
     * Make request global.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Class constructor.
     *
     * @param \Illuminate\Http\Request $request User Request
     *
     * @return void
     */
    public function __construct(Request $request) {
        $this->request = $request;

        //Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function index() {
        $items = Item::paginate(10);
        return view('shops.index')->with('items', $items);
    }

    public function searchProductsByNameOrCategory(Request $request) {
        $keywords = $request->input('search_product');
        $chosenRadioValue = $request->input('sort_by');
        $sortRadioValue = '';
        if ($chosenRadioValue == 'latest') {
            $sortRadioValue = 'desc';
        } else {
            $sortRadioValue = 'asc';
        }
        $items = Item::where('item_name', 'like', '%' .$keywords. '%')
                    ->orWhere('item_category', 'like', '%' .$keywords. '%')
                    ->orderBy('created_at', $sortRadioValue)
                    ->paginate(10);
        $items->appends(['sort_by' => $chosenRadioValue, 'search_product' => $keywords]);

        return view('shops.index')->with('items', $items);
    }

    public function checkout() {
        return view('shops.checkout');
    }

    public function checkoutContent(Request $request) {
        $initItems = $request->all();
        $items = json_decode($initItems['items'], true);
        
        return view('shops.checkout-content')->with('items', $items)->render();
    }

    // Midtrans controller
    
    /**
     * Submit donation.
     *
     * @return array
     */
    public function submitOrder(Request $request) {
        $order_id = $this->generateOrderId();
        $gross_amount = $request->input('gross_amount');
        $item_details = $request->input('item_details');
        $address = $request->input('address');
        $city = $request->input('city');
        $phone = $request->input('phone');
        $customer_id = Auth::user()->id;
        $customer_name = Auth::user()->name;
        $customer_email = Auth::user()->email;
        $shipping_address = array(
            'first_name'    => $customer_name,
            'last_name'     => '',
            'address'       => $address,
            'city'          => $city,
            'postal_code'   => '',
            'phone'         => $phone,
            'country_code'  => ''
        );

        // Buat transaksi ke midtrans kemudian save snap tokennya.
        $payload = [
            'transaction_details' => [
                'order_id'          => $order_id,
                'gross_amount'      => $gross_amount,
            ],
            'customer_details'      => [
                'first_name'        => $customer_name,
                'email'             => $customer_email,
                'phone'             => $phone,
                'shipping_address'   => $shipping_address
            ],
            'item_details' => [$item_details]
        ];

        $snapToken = Veritrans_Snap::getSnapToken($payload);

        //simpan snap token dan data order lainnya ke database

        //tabel Order
        $order = new Order;
        $order->order_id = $order_id;
        $order->user_id = $customer_id;
        $order->shipping_address = $address;
        $order->grandtotal = $gross_amount;
        $order->status = 'pending';
        $order->snap_token = $snap_token;
        $order->save();
        //tabel OrderDetails
        $total = 0;
        foreach ($item_details as $value) {
            $total = $value['quantity'] * $value['price'];
            $orderDet = new OrderDetails;
            $orderDet->order_id = $order_id;
            $orderDet->item_code = $value['id'];
            $orderDet->qty = $value['quantity'];
            $orderDet->price = $value['price'];
            $orderDet->total = $total;
            $orderDet->save();
        }

        $this->response['snap_token'] = $snapToken;
        return response()->json($this->response);
    }

    /**
     * Midtrans notification handler.
     *
     * @param Request $request
     *
     * @return void
     */
    public function notificationHandler(Request $request) {
        $notif = new Veritrans_Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;
        $order = Order::findOrFail($order_id);
        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order->setPending();
                } else {
                    $order->setSuccess();
                }
            }
        } elseif ($transaction == 'settlement') {
            $order->setSuccess();
        } elseif ($transaction == 'pending') {
            $order->setPending();
        } elseif ($transaction == 'deny') {
            $order->setFailed();
        } elseif ($transaction == 'expire') {
            $order->setExpired();
        } elseif ($transaction == 'cancel') {
            $order->setFailed();
        }

        //retrieve transaction status that has occured
        /*$order_status_obj = Veritrans_Transaction::status($order_id);
        $status = $order_status_obj->transaction_status;

        return $status;*/
    }

    public function checkoutFinish() {
        return view('shops.checkout-finish');
    }

    public function generateOrderId() {
        $order = Order::whereRaw('date(created_at) = ?', [date('Y-m-d')])->max('order_id');
        $zero = "0000";
        $orderId = "";

        if ($order == null || $order == "") {
            $orderId = "order-".date('Ymd')."-0001";
        } else {
            $orderExploded = explode('-', $order);
            $num = intval($orderExploded[2]) + 1;
            $numModified = substr($zero, 0, strlen($zero) - strlen(strval($num))).$num;
            $orderId = "order-".date('Ymd').'-'.$numModified;
        }

        return $orderId;
    }
}
