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

class TaskTableSeeder extends DatabaseSeeder
{

    /**
     * Maakt een nieuw Task-model aan in de tabel `tasks`.
     */
    public function run()
    {
//        $userA = DB::table('users')->where('email', 'demo.gebruiker.a@arteveldehs.be')->first();
        $userA = User::where('email', 'demo.gebruiker.a@arteveldehs.be')->first();

        // DemoTaak A
        Task::create([
            'name'    => 'DemoTaak A',
            'user_id' => $userA->id,
        ]);

        // DemoTaak B
        $taskB = new Task();
        $taskB->name = 'DemoTaak B';
        $taskB->user()->associate($userA);
        $taskB->save();
    }

}
