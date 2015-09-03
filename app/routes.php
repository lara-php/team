<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	$ps = DB::select("SELECT product.name, product.id FROM basket_product LEFT join basket ON basket_product.basketId=basket.id LEFT join product ON basket_product.productId=product.id GROUP BY product.id ORDER BY SUM(basket.productCount*basket.price)DESC LIMIT 8");

	$basket = Basket::where('sessionId', '=', Session::getId())->first();

	return View::make('index')
		->with('ps', $ps)
		->with('basket', $basket);

});


Route::get('basket/product-list', ['as' => 'basket.list', function()
{

	$basket = Basket::where('sessionId', '=', Session::getId())->first();

	return View::make('basket.list')->with('basket', $basket);

}]);

