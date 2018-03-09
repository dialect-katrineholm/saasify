<?php

class AccessTest extends \Dialect\Saasify\TestCase {

	/** @test */
	public function it_returns_true_if_user_can_access_model(){
		$user = User::create();
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(10))->save();

		saasify()->model()->setModel(Item::class)->setModule($module)->save();
		$module->addPlan($plan);
		$user->addPlan($plan);
		$this->assertTrue($user->canAccess(Item::class));

	}

	/** @test */
	public function it_returns_false_if_user_cant_access_model(){
		$user = User::create();
		$this->assertFalse($user->canAccess(Item::class));

	}

	/** @test */
	public function it_returns_true_if_user_can_create_model(){
		$user = User::create();
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(10))->save();

		saasify()->model()
		         ->setModel(Item::class)
		         ->setModule($module)
			     ->setCanCreate(true)
		         ->save();
		$module->addPlan($plan);
		$user->addPlan($plan);
		$this->assertTrue($user->canCreate(Item::class));

	}

	/** @test */
	public function it_returns_false_if_user_cant_create_model(){
		$user = User::create();
		$this->assertFalse($user->canCreate(Item::class));

	}

	/** @test */
	public function it_returns_true_if_user_can_update_model(){
		$user = User::create();
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(10))->save();

		saasify()->model()
		         ->setModel(Item::class)
		         ->setModule($module)
		         ->setCanUpdate(true)
		         ->save();
		$module->addPlan($plan);
		$user->addPlan($plan);
		$this->assertTrue($user->canUpdate(Item::class));

	}

	/** @test */
	public function it_returns_false_if_user_cant_update_model(){
		$user = User::create();
		$this->assertFalse($user->canUpdate(Item::class));

	}

	/** @test */
	public function it_returns_true_if_user_can_delete_model(){
		$user = User::create();
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(10))->save();

		saasify()->model()
		         ->setModel(Item::class)
		         ->setModule($module)
		         ->setCanDelete(true)
		         ->save();
		$module->addPlan($plan);
		$user->addPlan($plan);
		$this->assertTrue($user->canDelete(Item::class));

	}

	/** @test */
	public function it_returns_false_if_user_cant_delete_model(){
		$user = User::create();
		$this->assertFalse($user->canDelete(Item::class));

	}

	/** @test */
	public function it_uses_saasifyCurrent_helper_on_model_to_get_count_if_available(){
		$user = User::create();
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(10))->save();

		saasify()->model()
		         ->setModel(Item::class)
		         ->setModule($module)
		         ->setCanUpdate(true)
		         ->save();
		$module->addPlan($plan);
		$user->addPlan($plan);

		$this->assertEquals(100, $user->getCount(Item::class));
	}

	/** @test */
	public function it_returns_zero_if_saasifyCurrent_is_not_available(){
		$user = User::create();
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(10))->save();

		saasify()->model()
		         ->setModel(Product::class)
		         ->setModule($module)
		         ->setCanUpdate(true)
		         ->save();
		$module->addPlan($plan);
		$user->addPlan($plan);

		$this->assertEquals(0, $user->getCount(Product::class));
	}

	/** @test */
	public function it_returns_negative_one_if_has_no_access_to_model(){
		$user = User::create();
		$plan = saasify()->plan()->setName(str_random(10))->save();
		$module = saasify()->module()->setName(str_random(10))->save();

		saasify()->model()
		         ->setModel(Product::class)
		         ->setModule($module)
		         ->setCanUpdate(true)
		         ->save();
		$module->addPlan($plan);
		$user->addPlan($plan);

		$this->assertEquals(-1, $user->getCount(Item::class));
	}
}