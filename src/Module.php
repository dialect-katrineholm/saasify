<?php
namespace Dialect\Saasify;
use Dialect\Saasify\Builders\ModelBuilder;
use Dialect\Saasify\Builders\PlanBuilder;
use Dialect\Saasify\Models\SaasifyModule;

class Module extends  SaasifyObject {
	public $name;
	function __construct($rawModel = null) {
		Parent::__construct($rawModel ? $rawModel : new SaasifyModule());

	}

	public function setName($name){
		$this->name = $name;

		return $this;
	}


	public function plans($query = null){

		$builder = new PlanBuilder($this->rawModel->plans());
		if($query){
			$builder = $builder->query($query);
		}

		return $builder;
	}

	public function addPlan(Plan $plan){
		$this->rawModel->plans()->sync($plan->getRawModel()->id, false);

		return $this;
	}

	public function removePlan(Plan $plan){
		$this->rawModel->plans()->detach($plan->getRawModel()->id, false);

		return $this;
	}

	public function models($query = null){

		$builder = new ModelBuilder($this->rawModel->models());
		if($query){
			$builder = $builder->query($query);
		}

		return $builder;
	}


	public function removeModel(Model $model){
		$model->delete();

		return $this;
	}


	public function save(){
		$this->rawModel->name = $this->name;

		$this->rawModel->save();

		return $this;
	}

}