<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/shop', 'ShopsController@index')->name('shop.index');

Route::resource('items', 'ItemsController');
Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin', 'HomeController@admin');
    Route::resource('items', 'ItemsController');
    Route::get('/searchItems', 'ItemsController@searchItemByName');
    Route::get('/searchProducts', 'ShopsController@searchProductsByNameOrCategory');
    Route::get('/checkout', 'ShopsController@checkout');
    Route::post('/checkout-content', 'ShopsController@checkoutContent');
    Route::resource('orders', 'OrdersController');
    Route::get('/searchOrders', 'OrdersController@searchOrderByName');
    Route::post('/orderdetails', 'OrdersController@getOrderDetails')->name('orderdetails.index');
    //Midtrans routes
    Route::post('/checkout/finish', 'ShopsController@checkoutFinish')->name('checkout.finish');
    /*Route::post('/finish', function(){
        return redirect()->route('welcome');
    })->name('checkout.finish');*/

    Route::post('/checkout/store', 'ShopsController@submitOrder')->name('checkout.store');
    Route::post('/notification/handler', 'ShopsController@notificationHandler')->name('notification.handler');
});

