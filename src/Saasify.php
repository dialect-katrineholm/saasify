<?php
namespace Dialect\Saasify;

use Dialect\Saasify\Builders\ModelBuilder;
use Dialect\Saasify\Builders\ModuleBuilder;
use Dialect\Saasify\Builders\PlanBuilder;

class Saasify{

	function __construct() {

	}

	public function plan(){
		return new Plan();
	}

	public function plans($query = null){
		$builder = new PlanBuilder();
		if($query){
			$builder->query($query);
		}

		return $builder;
	}

	public function module(){
		return new Module();
	}

	public function modules($query = null){
		$builder = new ModuleBuilder();
		if($query){
			$builder->query($query);
		}

		return $builder;
	}

	public function model(){
		return new Model();
	}

	public function models($query = null){
		$builder = new ModelBuilder();
		if($query){
			$builder->query($query);
		}

		return $builder;
	}

}