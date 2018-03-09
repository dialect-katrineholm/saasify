<?php
use Dialect\Saasify\Traits\HasPlans;
use Illuminate\Database\Eloquent\Model;
class User extends Model{
	use HasPlans;
	protected $guarded = [];
	protected $table = "saasify_users";

}

class Item extends Model{

	protected $guarded = [];
	protected $table = "saasify_items";

	public static function saasifyCurrent($model){
		return 100;
	}

}

class Product extends Model{

	protected $guarded = [];
	protected $table = "saasify_products";



}