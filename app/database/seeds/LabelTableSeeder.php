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
 */

class LabelTableSeeder extends DatabaseSeeder
{

    /**
     * Maakt nieuwe Label-modellen aan in de tabel `labels`.
     */
    public function run()
    {
        $userA = User::find(1);
        $userB = User::find(2);

        // DemoLabel A
        $labelA = new Label();
        $labelA->name = 'DemoLabel A';
        $labelA->colour = "FF0000";
        $labelA->user()->associate($userA);
        $labelA->save();

        // DemoLabel B
        Label::create([
            'name' => 'DemoLabel B',
        ]);

        // DemoLabel C
        Label::create([
            'name'   => 'DemoLabel C',
            'colour' => '00FF00',
        ]);

        // DemoLabel D
        $labelD = new Label();
        $labelD->name = 'DemoLabel D';
        $labelD->user()->associate($userB);
        $labelD->save();
    }

}
