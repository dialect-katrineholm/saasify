<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaasifyModelsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('saasify_models', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('saasify_module_id');
			$table->string('model_class');
			$table->boolean('can_create')->default(1);
			$table->boolean('can_update')->default(1);
			$table->boolean('can_delete')->default(1);
			$table->integer('max_count')->default(0);
			$table->timestamps();
			$table->foreign('saasify_module_id')->references('id')->on('saasify_modules');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('saasify_module_models');
	}
}
