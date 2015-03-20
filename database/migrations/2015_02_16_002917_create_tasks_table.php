<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned();
			$table->string('name');
			$table->text('description')->nullable();
			$table->boolean('is_complete');
			$table->timestamps();
			$table->softDeletes();

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
		Schema::drop('tasks');
	}

}
