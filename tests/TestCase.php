<?php
namespace Dialect\Saasify;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;


class TestCase extends \Orchestra\Testbench\TestCase
{
	use RefreshDatabase;


	protected function setUp() {
		parent::setUp();
		$this->migrateTestUserTable();
		$this->migrateTestItemTable();
		$this->migrateTestProductTable();

	}

	protected function getPackageProviders($app)
	{
		return [SaasifyServiceProvider::class];
	}

	protected function migrateTestUserTable(){
		Schema::create('saasify_users', function ($table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->timestamps();
		});
	}

	protected function migrateTestItemTable(){
		Schema::create('saasify_items', function ($table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->timestamps();
		});
	}

	protected function migrateTestProductTable(){
		Schema::create('saasify_products', function ($table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->timestamps();
		});
	}

}