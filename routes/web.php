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
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
	Route::get('/home', 'HomeController@index')->name('home');

	Route::resource('products','ProductsController');
	Route::resource('clients','ClientsController');
	Route::resource('providers','ProvidersController');
	Route::resource('requestsorders','RequestsOrderController');
	Route::resource('purchaseorders','PurchaseOrderController');

	Route::resource('quotations','QuotationsController');
	Route::get('clients/{user_id}/search','QuotationsController@search_clients');
	Route::get('products/{user_id}/search','QuotationsController@search_products');
	Route::get('products/{product_id}/add','QuotationsController@products_add');
	Route::get('products/{product_id}/delete','QuotationsController@product_delete');

});

