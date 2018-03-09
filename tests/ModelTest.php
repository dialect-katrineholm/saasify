<?php

class ModelTest extends \Dialect\Saasify\TestCase {

	/** @test */
	public function it_can_create_a_model(){
		$module = saasify()->module()->setName(str_random(10))->save();
		saasify()->model()->setModel(Item::class)->setModule($module)->save();

		$this->assertDatabaseHas('saasify_models', [ 'model_class' => Item::class]);
	}

	/** @test */
	public function it_can_update_a_model(){
		$module = saasify()->module()->setName(str_random(10))->save();
		$oldMaxCount = 100;
		$newMaxCount = 200;
		$model =saasify()->model()->setModel(Item::class)->setModule($module)->setMaxCount($oldMaxCount)->save();
		$model = $model->setMaxCount($newMaxCount)->save();

		$this->assertDatabaseHas('saasify_models', [
			'model_class' => Item::class,
			'max_count' => $newMaxCount
		]);
		$this->assertDatabaseMissing('saasify_models', [
			'model_class' => Item::class,
			'max_count' => $oldMaxCount
		]);
	}

	/** @test */
	public function it_can_remove_a_model(){
		$module = saasify()->module()->setName(str_random(10))->save();
		saasify()->model()->setModel(Item::class)->setModule($module)->save()->delete();
		$this->assertDatabaseMissing('saasify_models', [ 'model_class' => Item::class]);
	}


	/** @test */
	public function it_can_get_all_models(){
		$module = saasify()->module()->setName(str_random(10))->save();
		saasify()->model()->setModel(Item::class)->setModule($module)->save();
		saasify()->model()->setModel(Product::class)->setModule($module)->save();

		$this->assertCount(2, saasify()->models()->all());
	}

	/** @test */
	public function it_can_count_models(){
		$module = saasify()->module()->setName(str_random(10))->save();
		saasify()->model()->setModel(Item::class)->setModule($module)->save();
		saasify()->model()->setModel(Product::class)->setModule($module)->save();
		$this->assertEquals(2, saasify()->models()->count());
	}

	/** @test */
	public function it_can_query_models(){
		$module = saasify()->module()->setName(str_random(10))->save();
		saasify()->model()->setModel(Item::class)->setModule($module)->save();
		saasify()->model()->setModel(Product::class)->setModule($module)->save();


		$models = saasify()->models()->query(function($query){
			return $query->where('model_class', Item::class);
		})->get();

		$this->assertCount(1, $models);
		$this->assertEquals($models->first()->modelClass, Item::class);
	}

}