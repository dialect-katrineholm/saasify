<?php

namespace Dialect\Saasify\Models;

use Illuminate\Database\Eloquent\Model;

class SaasifyPlan extends Model
{
	protected $table = 'saasify_plans';
	protected $fillable = [
		'name',
		'price'
	];

	public function modules(){
		return $this->belongsToMany(SaasifyModule::class, 'saasify_plan_modules');
	}

	public function plannables(){
		return $this->morphTo();
	}

}
