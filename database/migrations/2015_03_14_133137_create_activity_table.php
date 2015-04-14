<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('action');

			$table->string('subject_type');
			$table->integer('subject_id');

			$table->integer('user_id')->unsigned();
			$table->integer('project_id')->unsigned();
			$table->integer('task_id')->unsigned()->nullable();

			$table->timestamps();

			$table->foreign('project_id')
				->references('id')
				->on('projects')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activity');
	}

}
