<?php
namespace Dialect\Saasify\Traits;

use Dialect\Saasify\Builders\PlanBuilder;
use Dialect\Saasify\Plan;
use Dialect\Saasify\Models\SaasifyPlan;

trait HasPlans{
	public function rawSaasifyPlans(){
		return $this->morphToMany(SaasifyPlan::class, 'plannable', 'saasify_plannables');
	}

	public function getRawSaasifyModulesAttribute(){
		$modules = collect();
		$this->load(['rawSaasifyPlans.modules' => function($query)use(&$modules){
			$modules = $query->get()->unique();
		}]);
		return $modules;
	}

	public function getRawSaasifyModelsAttribute(){
		$models = collect();
		$this->load(['rawSaasifyPlans.modules.models' => function($query)use(&$models){
			$models = $query->get()->unique();
		}]);
		return $models;
	}

	public function plans($query = null){

		$builder = new PlanBuilder($this->rawSaasifyPlans());
		if($query){
			$builder = $builder->query($query);
		}

		return $builder;
	}

	public function addPlan(Plan $plan){
		$this->rawSaasifyPlans()->sync($plan->getRawModel()->id, false);
		return $this;
	}

	public function removePlan(Plan $plan){
		$this->rawSaasifyPlans()->detach($plan->getRawModel()->id, false);
		return $this;
	}

	public function getCount($model){
		if(!is_string($model)){
			$model = get_class($model);
		}
		if(!$this->canAccess($model)){
			return -1;
		}

		if(method_exists($model, 'saasifyCurrent')){
			return $model::saasifyCurrent($model);
		}

		return 0;
	}

	public function canAccess($model){
		if(!is_string($model)){
			$model = get_class($model);
		}

		return !!$this->rawSaasifyModels->where('model_class', $model)->count();
	}

	public function canCreate($model, $current_count = null){
		if(!is_string($model)){
			$model = get_class($model);
		}
		$current_count == null ? $this->getCount($model) : $current_count;

		$canCreate = !!$this->rawSaasifyModels->where('model_class', $model)->where('can_create', 1)->count();

		$maxCount = $this->rawSaasifyModels->max('max_count');
		return $canCreate && ($maxCount == 0 || $current_count < $maxCount);
	}

	public function canUpdate($model){
		if(!is_string($model)){
			$model = get_class($model);
		}
		return !!$this->rawSaasifyModels->where('model_class', $model)->where('can_update', 1)->count();
	}

	public function canDelete($model){
		if(!is_string($model)){
			$model = get_class($model);
		}
		return !!$this->rawSaasifyModels->where('model_class', $model)->where('can_delete', 1)->count();
	}
}