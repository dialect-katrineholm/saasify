<?php

class ModulePlanTest extends \Dialect\Saasify\TestCase {

	/** @test */
	public function it_can_add_module_to_plan(){
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(9))->save();

		$plan->addModule($module);

		$this->assertDatabaseHas('saasify_plan_modules', [
			'saasify_plan_id' => $plan->getRawModel()->id,
			'saasify_module_id' => $module->getRawModel()->id
		]);
	}

	/** @test */
	public function it_can_remove_module_from_plan(){
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(9))->save();

		$plan->addModule($module)->removeModule($module);

		$this->assertDatabaseMissing('saasify_plan_modules', [
			'saasify_plan_id' => $plan->getRawModel()->id,
			'saasify_module_id' => $module->getRawModel()->id
		]);
	}

	/** @test */
	public function it_can_get_a_ModuleBuilder_from_plan(){
		$plan = saasify()->plan()->setName(str_random(10))->save();

		$this->assertEquals(get_class($plan->modules()),'Dialect\Saasify\Builders\ModuleBuilder');
	}

	/** @test */
	public function ModuleBuilder_from_plan_only_gets_modules_added_to_plan(){
		$moduleName = str_random(9);
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName($moduleName)->save();
		saasify()->module()->setName(str_random(8))->save();
		$plan->addModule($module);

		$planModules = $plan->modules()->get();

		$this->assertCount(1, $planModules);
		$this->assertEquals($planModules->first()->name, $moduleName);
	}

	/** @test */
	public function it_can_only_add_the_same_module_once_to_plan(){
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(9))->save();

		$plan->addModule($module)->addModule($module);

		$this->assertCount(1, $plan->modules()->get());
	}

	/** @test */
	public function it_can_add_plan_to_module(){
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(9))->save();

		$module->addPlan($plan);

		$this->assertDatabaseHas('saasify_plan_modules', [
			'saasify_plan_id' => $plan->getRawModel()->id,
			'saasify_module_id' => $module->getRawModel()->id
		]);
	}

	/** @test */
	public function it_can_remove_plan_from_module(){
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(9))->save();

		$module->addPlan($plan)->removePlan($plan);

		$this->assertDatabaseMissing('saasify_plan_modules', [
			'saasify_plan_id' => $plan->getRawModel()->id,
			'saasify_module_id' => $module->getRawModel()->id
		]);
	}

	/** @test */
	public function it_can_get_a_PlanBuilder_from_module(){
		$module = saasify()->module()->setName(str_random(9))->save();

		$this->assertEquals(get_class($module->plans()),'Dialect\Saasify\Builders\PlanBuilder');
	}

	/** @test */
	public function PlanBuilder_from_module_only_gets_plans_added_to_module(){
		$planName = str_random(10);
		saasify()->plan()->setName(str_random(8))->save();
		$plan = saasify()->plan()->setName($planName)->save();
		$module = saasify()->module()->setName(str_random(10))->save();

		$module->addPlan($plan);

		$modulePlans = $module->plans()->get();

		$this->assertCount(1, $modulePlans);
		$this->assertEquals($modulePlans->first()->name, $planName);
	}

	/** @test */
	public function it_can_only_add_the_same_plan_once_to_module(){
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(9))->save();

		$module->addPlan($plan)->addPlan($plan);

		$this->assertCount(1, $module->plans()->get());
	}


}