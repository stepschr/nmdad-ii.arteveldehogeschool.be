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
 * $ php artisan migrate:make create_label_pomodoro_table --create=label_pomodoro
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelPomodoroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /**
         * Naam is de alfabetisch de namen van de Model-klassen.
         */
        Schema::create('label_pomodoro', function(Blueprint $table)
		{
            // Kolommen
			$table->integer('pomodoro_id')
                  ->unsigned() // PK's zijn altijd unsigned in Eloquent.
            ;
            $table->integer('label_id')
                  ->unsigned() // PK's zijn altijd unsigned in Eloquent.
            ;

            // Indexen
            $table->primary(['pomodoro_id', 'label_id']); // Samengestelde sleutel (composite key).
            $table->foreign('pomodoro_id')
                  ->references('id')->on('pomodori')
                  ->onDelete('cascade') // Als een Pomodoro verwijderd wordt, dan worden alle rijen in deze tussentabel mee verwijderd.
            ;
            $table->foreign('label_id')
                  ->references('id')->on('labels')
                  ->onDelete('cascade') // Als een Label verwijderd wordt, dan worden alle rijen in deze tussentabel mee verwijderd.
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
		Schema::drop('label_pomodoro');
	}

}
