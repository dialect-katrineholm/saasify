<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaasifyPlanModulesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('saasify_plan_modules', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('saasify_plan_id')->unsigned();
			$table->integer('saasify_module_id')->unsigned();
			$table->foreign('saasify_plan_id')->references('id')->on('saasify_plans');
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
		Schema::dropIfExists('saasify_mosaasify_plan_modulesdule_plan');
	}
}
