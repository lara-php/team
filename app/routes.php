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

Route::post('add-to-basket', ['as' => 'add.to.basket', function()
{

	//$id    = Input::get('id');
	//$count = Input::get('count', 1);


	// create or find old basket
	$basket = Basket::where('sessionId', '=', Session::getId())->first();

	if (!$basket)
	{
		$basket = new Basket;
		$basket->price = 0;
		$basket->productCount = 0;
		$basket->status = Basket::STATUS_UNPAYED;
		$basket->date = date('Y-m-d H:i:s');
		$basket->sessionId = Session::getId();
		$basket->save();
	}

	// find prodcudt
	$product = Product::find(Input::get('id'));

	// add product to pasket products
	$bp = new BasketProduct;
	$bp->basketId  = $basket->id;
	$bp->productId = $product->id;
	$bp->count     = Input::get('count');
	$bp->price     = $product->price;
	$bp->save();

	// 
	$row = DB::table('basket_product')
		->select(DB::raw('SUM(price) as p'), DB::raw('SUM(count) as c'))
		->where('basketId', '=', $basket->id)
		->first();

	//
	$basket->price        = $row->p;
	$basket->productCount = $row->c;
	$basket->save();

	//
	return ['cost' => $row->p, 'count' => $row->c];
}]);
