<?php

class Product extends Eloquent
{
	protected $table = 'product';


	public function category()
	{
		return $this->belongsTo('Category');
	}
}