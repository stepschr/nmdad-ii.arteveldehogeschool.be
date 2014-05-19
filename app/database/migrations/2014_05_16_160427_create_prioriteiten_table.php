<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrioriteitenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('prioriteiten', function(Blueprint $table)
        {
            // Kolommen
            $table->increments('id');
            $table->string('name', 255);
            $table->string('class', 255);
            $table->timestamps();

        });

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('prioriteiten');
	}

}
