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

class UserTableSeeder extends DatabaseSeeder
{

    /**
     * Maakt een nieuw User-model aan in de tabel `users`.
     */
    public function run()
    {
        // DemoUser A
        $userA = new User();
        $userA->email      = 'demo.gebruiker.a@arteveldehs.be';
        $userA->password   = 'testtest';
        $userA->username = 'DemoGebruikerA';
        $userA->save();

        // DemoUser B
        User::create([
            'email'      => 'demo.gebruiker.b@arteveldehs.be',
            'password'   => 'test',
            'username' => 'DemoGebruikerB',
        ]);


    }

}
