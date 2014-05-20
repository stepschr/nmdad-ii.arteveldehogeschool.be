<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('lists', function(Blueprint $lists)
        {
            // Kolommen
            $lists->increments('id');
            $lists->string('name', 255);
            $lists->integer('user_id')
                ->unsigned()
            ;

            $lists->timestamps();  // Voegt de kolommen `created_at` en `updated_at` toe.
            $lists->softDeletes(); // Voegt de kolom `deleted_at` toe.

            // Indexen
            $lists->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade') // Als een User verwijderd wordt, dan worden alle Tasks van die User mee verwijderd.
            ;
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('lists');
	}

}
