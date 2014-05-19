<?php
/**
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                                                           *
 *                                                                           *
 *                                                                           *
 *                        aaaAAaaa            HHHHHH                         *
 *                     aaAAAAAAAAAAaa         HHHHHH                         *
 *                    aAAAAAAAAAAAAAAa        HHHHHH                         *
 *                   aAAAAAAAAAAAAAAAAa       HHHHHH                         *
 *                   aAAAAAa    aAAAAAA                                      *
 *                   AAAAAa      AAAAAA                                      *
 *                   AAAAAa      AAAAAA                                      *
 *                   aAAAAAa     AAAAAA                                      *
 *                    aAAAAAAaaaaAAAAAA       HHHHHH                         *
 *                     aAAAAAAAAAAAAAAA       HHHHHH                         *
 *                      aAAAAAAAAAAAAAA       HHHHHH                         *
 *                         aaAAAAAAAAAA       HHHHHH                         *
 *                                                                           *
 *                                                                           *
 *                                                                           *
 *      a r t e v e l d e  u n i v e r s i t y  c o l l e g e  g h e n t     *
 *                                                                           *
 *                                                                           *
 *                                MEMBER OF GHENT UNIVERSITY ASSOCIATION     *
 *                                                                           *
 *                                                                           *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 * @author     Olivier Parent
 * @copyright  Copyright © 2014 Artevelde University College Ghent
 *
 * Migration maken:
 * ----------------
 * $ php artisan migrate:make create_labels_table --create=labels
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('labels', function(Blueprint $table)
		{
            // Kolommen
			$table->increments('id');
            $table->string('name', 255)
                  ->unique() // Waarde moet uniek zijn in de tabelkolom.
            ;
            $table->string('colour', 6)
                  ->nullable() // Waarde is niet verplicht.
            ;
            $table->integer('user_id')
                  ->unsigned() // PK's zijn altijd unsigned in Eloquent.
                  ->nullable() // Waarde is niet verplicht.
            ;
            $table->timestamps();  // Voegt de kolommen `created_at` en `updated_at` toe.
            $table->softDeletes(); // Voegt de kolom `deleted_at` toe.

            // Indexen
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade') // Als een User verwijderd wordt, dan worden alle Labels van die User mee verwijderd.
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
		Schema::drop('labels');
	}

}
