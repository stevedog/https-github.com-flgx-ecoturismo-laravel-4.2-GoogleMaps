<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resources', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('module');
			$table->string('action');

			$table->integer('user_created_id')->unsigned();
			$table->integer('user_updated_id')->unsigned()->nullable();
			
			$table->dateTime('created_at');
			$table->dateTime('updated_at')->nullable();	
			$table->dateTime('deleted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

	}

}
