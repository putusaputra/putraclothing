<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function index() {
        $title = 'Welcome to Putra Clothing Shop';
        return view('shops.index')->with('title', $title);
    }
}
