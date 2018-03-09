<?php

class User extends \Illuminate\Database\Eloquent\Model{
	use \Dialect\Saasify\Traits\HasPlans;
	protected $guarded = [];
	protected $table = "saasify_users";

}

class Item extends \Illuminate\Database\Eloquent\Model{

	protected $guarded = [];
	protected $table = "saasify_items";

	public static function saasifyCurrent($model){
		return 100;
	}

}

class Product extends \Illuminate\Database\Eloquent\Model{

	protected $guarded = [];
	protected $table = "saasify_products";



}