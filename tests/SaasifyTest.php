<?php

class SaasifyTest extends  \Dialect\Saasify\TestCase {

	/** @test */
	public function plan_returns_instance_of_Plan(){
		$this->assertEquals(get_class(saasify()->plan()), 'Dialect\Saasify\Plan');
	}

	/** @test */
	public function plans_returns_instance_of_PlanBuilder(){
		$this->assertEquals(get_class(saasify()->plans()), 'Dialect\Saasify\Builders\PlanBuilder');
	}

	/** @test */
	public function plans_can_take_a_callback_query_as_parameter(){
		$this->assertEquals(get_class(saasify()->plans(function($query){ return $query;})), 'Dialect\Saasify\Builders\PlanBuilder');
	}

	/** @test */
	public function module_returns_instance_of_Module(){
		$this->assertEquals(get_class(saasify()->module()), 'Dialect\Saasify\Module');
	}

	/** @test */
	public function modules_returns_instance_of_ModuleBuilder(){
		$this->assertEquals(get_class(saasify()->modules()), 'Dialect\Saasify\Builders\ModuleBuilder');
	}

	/** @test */
	public function modules_can_take_a_callback_query_as_parameter(){
		$this->assertEquals(get_class(saasify()->modules(function($query){ return $query;})), 'Dialect\Saasify\Builders\ModuleBuilder');
	}

	/** @test */
	public function model_returns_instance_of_Model(){
		$this->assertEquals(get_class(saasify()->model()), 'Dialect\Saasify\Model');
	}

	/** @test */
	public function models_returns_instance_of_ModelBuilder(){
		$this->assertEquals(get_class(saasify()->models()), 'Dialect\Saasify\Builders\ModelBuilder');
	}

	/** @test */
	public function  models_can_take_a_callback_query_as_parameter(){
		$this->assertEquals(get_class(saasify()-> models(function($query){ return $query;})), 'Dialect\Saasify\Builders\ModelBuilder');
	}
}