<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('admins', function(Blueprint $table)
        {
            $table->increments('id'); // Increments zijn altijd UNSIGNED, let op met FK's!
            $table->string('email', 255)->unique();
            $table->string('password', 60); // Ingebouwde authenticatie gebruikt een hashcode van 60 tekens, inclusief salt.
            $table->string('username', 45);
            $table->string('remember_token', 100); // Nodig sinds Laravel 4.1.26
            $table->timestamps();  // Voegt de kolommen `created_at` en `updated_at` toe.
            $table->softDeletes(); // Voegt de kolom `deleted_at` toe.
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('admins');
	}

}
