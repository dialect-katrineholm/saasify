<?php

namespace Dialect\Saasify\Models;

use Illuminate\Database\Eloquent\Model;

class SaasifyModel extends Model
{
	protected $table = 'saasify_models';
	protected $fillable = [
		'model',
		'can_create',
		'can_update',
		'can_delete',
		'max_count'
	];

	public function module(){
		return $this->belongsTo(SaasifyModule::class, 'saasify_module_id');
	}

}
