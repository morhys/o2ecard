<?php

class Create_Ecardoptions_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ecardoptions', function($table) {
		    $table->increments('id');
		    $table->string('title')->nullable();
		    $table->string('image');
		    $table->string('thumb')->nullable();
		    $table->string('dimensions');
		    $table->string('placeholder');
		    $table->timestamps();
		});

		$seedData = Config::get('application.ecards');

        if ($seedData):
	        foreach ($seedData as $seed) {
	        	DB::table('ecardoptions')->insert(array(
	        		'image' => $seed['image'],
	        		'thumb' => $seed['thumb'],
	        		'dimensions' => json_encode($seed['dimensions']),
	        		'placeholder' => json_encode($seed['placeholder'])
	        	));
	        }
        endif;
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ecardoptions');
	}

}