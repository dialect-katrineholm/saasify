<?php
namespace Dialect\Saasify;
use Dialect\Saasify\Builders\ModelBuilder;
use Dialect\Saasify\Builders\ModuleBuilder;
use Dialect\Saasify\Builders\PlanBuilder;
use Dialect\Saasify\Models\SaasifyModel;

class Model extends SaasifyObject {
	public $modelClass;
	public $canCreate = true;
	public $canUpdate = true;
	public $canDelete = true;
	public $maxCount = 0;
	public $moduleId;
	function __construct($rawModel = null) {
		Parent::__construct($rawModel ? $rawModel : new SaasifyModel());
	}

	public function setModel($model){
		if(!is_string($model)){
			$model = get_class($model);
		}
		$this->modelClass = $model;

		return $this;
	}

	public function setModule(Module $module){
		$this->moduleId = $module->getRawModel()->id;

		return $this;
	}

	public function setCanCreate($canCreate){
		$this->canCreate = $canCreate;

		return $this;
	}

	public function setCanUpdate($canUpdate){
		$this->canUpdate = $canUpdate;

		return $this;
	}

	public function setCanDelete($canDelete){
		$this->canDelete = $canDelete;

		return $this;
	}

	public function setMaxCount($maxCount){
		$this->maxCount = $maxCount;

		return $this;
	}

	public function module(){

		$builder =  new ModuleBuilder($this->rawModel->module());
		return $builder->first();
	}


	public function save(){
		$this->rawModel->model_class = $this->modelClass;
		$this->rawModel->can_create = $this->canCreate;
		$this->rawModel->can_update = $this->canUpdate;
		$this->rawModel->can_delete = $this->canDelete;
		$this->rawModel->max_count = $this->maxCount;
		$this->rawModel->saasify_module_id = $this->moduleId;
		$this->rawModel->save();

		return $this;
	}

	public function plans($query = null){
		$builder = new PlanBuilder($this->model->plans());
		if($query){
			$builder->query($query);
		}
		return $builder;
	}

	public function addPlan(Plan $plan){
		$this->model->rawSaasifyPlans()->sync($plan->getModel()->id, false);

		return $this;
	}

	public function removePlan(Plan $plan){
		$this->model->rawSaasifyPlans()->detach($plan->getModel()->id);

		return $this;
	}

}