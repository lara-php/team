<?php

class Basket extends Eloquent
{

	const STATUS_UNPAYED  = 0;
	const STATUS_PAYED    = 1;
	const STATUS_CANCELED = 2;

	protected $table = 'basket';

	//public $timestamps = false;

	public function products()
	{
		return $this->belongsToMany('Product', 'basket_product', 'basketId', 'productId');
	}
}