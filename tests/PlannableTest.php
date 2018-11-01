<?php

class PlannableTest extends \Dialect\Saasify\TestCase {

	/** @test */
	public function it_can_add_user_to_plan(){
		$user = User::create();
		$plan = saasify()->plan()->setName(str_random(10))->save();

		$plan->addUser($user);

		$this->assertDatabaseHas('saasify_plannables', [
			'saasify_plan_id' => $plan->getRawModel()->id,
			'plannable_id' => $user->id,
			'plannable_type' => get_class($user)
		]);
	}

	/** @test */
	public function it_can_remove_user_from_plan(){
		$user = User::create();
		$plan = saasify()->plan()->setName(str_random(10))->save();

		$plan->addUser($user)->removeUser($user);

		$this->assertDatabaseMissing('saasify_plannables', [
			'saasify_plan_id' => $plan->getRawModel()->id,
			'plannable_id' => $user->id,
			'plannable_type' => get_class($user)
		]);
	}

	/** @test */
	public function it_can_add_plan_to_user(){
		$user = User::create();
		$plan = saasify()->plan()->setName(str_random(10))->save();

		$user->addPlan($plan);

		$this->assertDatabaseHas('saasify_plannables', [
			'saasify_plan_id' => $plan->getRawModel()->id,
			'plannable_id' => $user->id,
			'plannable_type' => get_class($user)
		]);
	}

	/** @test */
	public function it_can_remove_plan_from_user(){
		$user = User::create();
		$plan = saasify()->plan()->setName(str_random(10))->save();

		$user->addPlan($plan)->removePlan($plan);

		$this->assertDatabaseMissing('saasify_plannables', [
			'saasify_plan_id' => $plan->getRawModel()->id,
			'plannable_id' => $user->id,
			'plannable_type' => get_class($user)
		]);
	}

	/** @test */
	public function user_plans_returns_a_PlanBuilder(){
		$user = User::create();
		$this->assertEquals(get_class($user->plans()),'Dialect\Saasify\Builders\PlanBuilder');
	}

	/** @test */
	public function it_only_gets_plans_linked_to_user(){
		$user = User::create();
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$plan2 = saasify()->plan()->setName(str_random(9))->save();
		saasify()->plan()->setName(str_random(8))->save();
		$user->addPlan($plan)->addPlan($plan2);
		$this->assertCount(2, $user->plans()->get());
	}

    /** @test */
    public function it_can_check_if_user_has_plan() {
        $user = User::create();
        $plan = saasify()->plan()->setName(str_random(10))->save();
        $user->addPlan($plan);
        $this->assertTrue($user->hasPlan($plan->name));
        $this->assertFalse($user->hasPlan('this_does_not_exist'));
    }

    /** @test */
    public function it_can_check_if_user_has_module() {
        $user = User::create();
        $plan = saasify()->plan()->setName(str_random(10))->save();
        $module = saasify()->module()->setName(str_random(10))->save();
        $plan->addModule($module);
        $user->addPlan($plan);
        $this->assertTrue($user->hasModule($module->name));
        $this->assertFalse($user->hasModule('this_does_not_exist'));
    }

}