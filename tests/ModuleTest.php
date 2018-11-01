<?php

class ModuleTest extends \Dialect\Saasify\TestCase {

	/** @test */
	public function it_can_create_a_module(){
		$name = str_random(10);
		saasify()->module()->setName($name)->save();

		$this->assertDatabaseHas('saasify_modules', [ 'name' => $name]);
	}

	/** @test */
	public function it_can_find_a_module(){
		$name = str_random(10);
		saasify()->module()->setName($name)->save();
		$module = saasify()->modules()->find($name);
		$this->assertNotNull($module);
		$this->assertEquals($name, $module->name);
	}

	/** @test */
	public function it_can_update_a_module(){
		$oldName = str_random(10);
		$newName = str_random(9);
		$module = saasify()->module()->setName($oldName)->save();
		$module = $module->setName($newName)->save();

		$this->assertDatabaseHas('saasify_modules', [ 'name' => $newName]);
		$this->assertDatabaseMissing('saasify_modules', [ 'name' => $oldName]);
	}

	/** @test */
	public function it_can_remove_a_module(){
		$name = str_random(10);
		saasify()->module()->setName($name)->save()->delete();
		$this->assertDatabaseMissing('saasify_modules', [ 'name' => $name]);
	}


	/** @test */
	public function it_can_get_all_modules(){

		saasify()->module()->setName(str_random(10))->save();
		saasify()->module()->setName(str_random(9))->save();
		$this->assertCount(2, saasify()->modules()->all());
	}

	/** @test */
	public function it_can_count_modules(){

		saasify()->module()->setName(str_random(10))->save();
		saasify()->module()->setName(str_random(9))->save();
		$this->assertEquals(2, saasify()->modules()->count());
	}

	/** @test */
	public function it_can_query_modules(){
		$name = str_random(9);
		saasify()->module()->setName(str_random(10))->save();
		saasify()->module()->setName($name)->save();


		$modules = saasify()->modules()->query(function($query) use ($name){
			return $query->where('name', $name);
		})->get();
		$this->assertCount(1, $modules);
		$this->assertEquals($modules->first()->name, $name);
	}



}