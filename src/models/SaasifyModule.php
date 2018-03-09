<?php

namespace Dialect\Saasify\Models;

use Illuminate\Database\Eloquent\Model;

class SaasifyModule extends Model
{
	protected $table = 'saasify_modules';
	protected $fillable = [
		'name'
	];

	public function plans(){
		return $this->belongsToMany(SaasifyPlan::class, 'saasify_plan_modules');
	}


	public function models(){
		return $this->hasMany(SaasifyModel::class);
	}

}
