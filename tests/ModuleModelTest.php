<?php

class ModuleModelTest extends \Dialect\Saasify\TestCase {

	/** @test */
	public function it_can_remove_model_from_module(){
		$module = saasify()->module()->setName(str_random(10))->save();
		$model = saasify()->model()->setModel(Item::class)->setModule($module)->save();
		$module->removeModel($model);

		$this->assertDatabaseMissing('saasify_models', [
			'saasify_module_id' => $module->getRawModel()->id,
			'model_class' => Item::class
		]);
	}

	/** @test */
	public function it_can_get_a_ModelBuilder_from_module(){
		$module = saasify()->module()->setName(str_random(9))->save();

		$this->assertEquals(get_class($module->models()),'Dialect\Saasify\Builders\ModelBuilder');
	}

	/** @test */
	public function ModelBuilder_from_module_only_gets_models_added_to_module(){
		$moduleName = str_random(9);
		$module = saasify()->module()->setName($moduleName)->save();
		$module2 = saasify()->module()->setName(str_random(10))->save();

		saasify()->model()->setModel(Item::class)->setModule($module)->save();
		saasify()->model()->setModel(Product::class)->setModule($module2)->save();
		$moduleModels = $module->models()->get();

		$this->assertCount(1, $moduleModels);
		$this->assertEquals($moduleModels->first()->modelClass, Item::class);
	}

	/** @test */
	public function it_can_get_module_from_model(){
		$modelName = str_random(10);
		$module = saasify()->module()->setName($modelName)->save();
		$model = saasify()->model()->setModel(Item::class)->setModule($module)->save();

		$retrievedModule = $model->module();
		$this->assertNotNull($retrievedModule);
		$this->assertEquals($retrievedModule->name, $modelName);
	}

}

