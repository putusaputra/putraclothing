<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Item;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::paginate(10);
        return view('internal-admin.list-item')->with('items', $items);
    }

    /**
     * Display search result of item by name
     *
     * @return \Illuminate\Http\Response
     */
    public function searchItemByName(Request $request)
    {
        $keywords = $request->input('search_item');
        $items = Item::where('item_name', 'like', '%' . $keywords . '%')->paginate(10);
        $items->appends(['search_item' => $keywords]);
        return view('internal-admin.list-item')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal-admin.create-item');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'item_category' => 'required',
            'item_name' => 'required',
            'item_preview' => 'required|max:1999',
            'item_material' => 'required',
            'item_size' => 'required',
            'item_src' => 'required',
            'item_alt' => 'required',
            'item_title' => 'required',
            'item_keywords' => 'required',
            'item_price' => 'required'
        ]);

        //Handle file upload
        if ($request->hasFile('item_preview')) {
            $filenameWithExt = $request->file('item_preview')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('item_preview')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('item_preview')->storeAs('public/t-shirts', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //Create Item
        $item = new Item;
        $item->item_category = $request->input('item_category');
        $item->item_name = $request->input('item_name');
        $item->item_preview = $fileNameToStore;
        $item->item_material = $request->input('item_material');
        $item->item_size = $request->input('item_size');
        $item->item_src = $request->input('item_src');
        $item->item_alt = $request->input('item_alt');
        $item->item_title = $request->input('item_title');
        $item->item_keywords = $request->input('item_keywords');
        $item->item_price = $request->input('item_price');
        $item->save();

        return redirect('/items')->with('success', 'Item Added!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return view('internal-admin.edit-item')->with('item', $item);
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
        $this->validate($request, [
            'item_category' => 'required',
            'item_name' => 'required',
            'item_preview' => 'required|max:1999',
            'item_material' => 'required',
            'item_size' => 'required',
            'item_src' => 'required',
            'item_alt' => 'required',
            'item_title' => 'required',
            'item_keywords' => 'required',
            'item_price' => 'required'
        ]);

        //Handle file upload
        if ($request->hasFile('item_preview')) {
            $filenameWithExt = $request->file('item_preview')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('item_preview')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('item_preview')->storeAs('public/t-shirts', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //Update Item
        $item = Item::find($id);
        $item->item_category = $request->input('item_category');
        $item->item_name = $request->input('item_name');
        if ($request->hasFile('item_preview')) {
            $item->item_preview = $fileNameToStore;
        }
        $item->item_material = $request->input('item_material');
        $item->item_size = $request->input('item_size');
        $item->item_src = $request->input('item_src');
        $item->item_alt = $request->input('item_alt');
        $item->item_title = $request->input('item_title');
        $item->item_keywords = $request->input('item_keywords');
        $item->item_price = $request->input('item_price');
        $item->save();

        return redirect('/items')->with('success', 'Item Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        if ($item->item_preview != 'noimage.jpg') {
            Storage::delete('public/t-shirts/' . $item->item_preview);
        }

        $item->delete();
        return redirect('/items')->with('success', 'Item Removed');
    }
}
