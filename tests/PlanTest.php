<?php

class PlanTest extends \Dialect\Saasify\TestCase {

	/** @test */
	public function it_can_create_a_plan(){
		$name = str_random(10);
		saasify()->plan()->setName($name)->save();

		$this->assertDatabaseHas('saasify_plans', [ 'name' => $name]);
	}

	/** @test */
	public function it_can_find_a_plan(){
		$name = str_random(10);
		saasify()->plan()->setName($name)->save();
		$plan = saasify()->plans()->find($name);
		$this->assertNotNull($plan);
		$this->assertEquals($name, $plan->name);
	}

	/** @test */
	public function it_can_update_a_plan(){
		$oldName = str_random(10);
		$newName = str_random(9);
		$plan = saasify()->plan()->setName($oldName)->save();
		$plan = $plan->setName($newName)->save();

		$this->assertDatabaseHas('saasify_plans', [ 'name' => $newName]);
		$this->assertDatabaseMissing('saasify_plans', [ 'name' => $oldName]);
	}

	/** @test */
	public function it_can_remove_a_plan(){
		$name = str_random(10);
		saasify()->plan()->setName($name)->save()->delete();
		$this->assertDatabaseMissing('saasify_plans', [ 'name' => $name]);
	}


	/** @test */
	public function it_can_get_all_plans(){

		saasify()->plan()->setName(str_random(10))->save();
		saasify()->plan()->setName(str_random(9))->save();
		$this->assertCount(2, saasify()->plans()->all());
	}

	/** @test */
	public function it_can_count_plans(){

		saasify()->plan()->setName(str_random(10))->save();
		saasify()->plan()->setName(str_random(9))->save();
		$this->assertEquals(2, saasify()->plans()->count());
	}

	/** @test */
	public function it_can_query_plans(){
		$name = str_random(9);
		saasify()->plan()->setName(str_random(10))->save();
		saasify()->plan()->setName($name)->save();


		$plans = saasify()->plans()->query(function($query) use ($name){
			return $query->where('name', $name);
		})->get();
		$this->assertCount(1, $plans);
		$this->assertEquals($plans->first()->name, $name);
	}

}