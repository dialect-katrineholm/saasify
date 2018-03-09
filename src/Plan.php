<?php
namespace Dialect\Saasify;
use Dialect\Saasify\Builders\ModuleBuilder;
use Dialect\Saasify\Models\SaasifyPlan;

class Plan extends SaasifyObject {
	public $name;
	public $price = 0;
	function __construct($rawModel = null) {
		Parent::__construct($rawModel ? $rawModel : new SaasifyPlan());

	}

	public function setName($name){
		$this->name = $name;

		return $this;
	}

	public function setPrice($price){
		$this->price = $price;

		return $this;
	}

	public function modules($query = null){

		$builder = new ModuleBuilder($this->rawModel->modules());
		if($query){
			$builder = $builder->query($query);
		}

		return $builder;
	}

	public function addModule(Module $module){
		$this->rawModel->modules()->sync($module->getRawModel()->id, false);

		return $this;
	}

	public function removeModule(Module $module){
		$this->rawModel->modules()->detach($module->getRawModel()->id, false);

		return $this;
	}

	public function addUser($plannable){
		$plannable->rawSaasifyPlans()->sync($this->rawModel->id, false);

		return $this;
	}

	public function removeUser($plannable){
		$plannable->rawSaasifyPlans()->detach($this->rawModel->id, false);

		return $this;
	}

	public function save(){
		$this->rawModel->name = $this->name;
		$this->rawModel->price = $this->price;

		$this->rawModel->save();

		return $this;
	}



}