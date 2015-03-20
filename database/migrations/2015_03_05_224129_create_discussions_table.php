<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discussions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('body')->nullable();
			$table->integer('user_id')->unsigned();
			$table->integer('task_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('task_id')
				->references('id')
				->on('tasks')
				->onDelete('cascade');

			$table->foreign('user_id')
				->references('id')
				->on('users')
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
		Schema::drop('discussions');
	}

}
