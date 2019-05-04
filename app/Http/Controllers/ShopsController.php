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
}
