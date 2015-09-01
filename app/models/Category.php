<?php

class Category extends Eloquent
{
	protected $table = 'category';


	public function products()
	{
		return $this->hasMany('Product', 'categoryId');
	}
}