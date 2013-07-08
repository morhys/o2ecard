<?php

class Create_Ecards_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ecards', function($table) {
		    $table->increments('id');
		    $table->integer('ecardoptions_id')->nullable();
		    $table->string('slug')->nullable();
		    $table->string('copy')->nullable();
		    $table->string('photo')->nullable();
		    $table->string('img')->nullable();
		    $table->string('thumb')->nullable();
		    $table->string('session_id');
		    $table->string('ip_address');
		    $table->string('user_agent')->nullable();
		    $table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ecards');
	}

}