<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ShopsController extends Controller
{
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
        //json_decode($initItems['items'])['items']->
        return view('shops.checkout-content')->with('items', $items)->render();
        //echo $initItems['items'];
        //echo $items->items[0]->itemName;
        //echo $items->items[0];
        /*foreach ($items->items[0] as $item) {
            echo $item->itemName;
        }*/
    }
}
