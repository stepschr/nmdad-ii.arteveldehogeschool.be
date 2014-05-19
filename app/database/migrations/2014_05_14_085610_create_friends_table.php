<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        Schema::create('friends', function(Blueprint $friends)
        {
            // Kolommen
            $friends->increments('id');

            $friends->integer('user_id')
                ->unsigned()
            ;
            $friends->integer('friends_id')
                ->unsigned()
            ;
            $friends->string('reason', 255);

            $friends->timestamp('accepted_at');
            $friends->timestamp('rejected_at');
            $friends->timestamp('blocked_at');
            $friends->timestamp('defriended_at');
            $friends->timestamps('created_at');
           // Voegt de kolommen `created_at` en `updated_at` toe.
            $friends->softDeletes(); // Voegt de kolom `deleted_at` toe.

            // Indexen
            $friends->foreign('user_id')
                ->references('id')->on('users')
                // Als een User verwijderd wordt, dan worden alle Tasks van die User mee verwijderd.
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
	    Schema::drop('friends');
	}

}
