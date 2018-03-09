<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaasifyPlannablesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('saasify_plannables', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('saasify_plan_id');
			$table->unsignedInteger('plannable_id');
			$table->string('plannable_type');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('saasify_plannables');
	}
}
