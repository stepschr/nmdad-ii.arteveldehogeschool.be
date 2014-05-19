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

class PomodoroTableSeeder extends DatabaseSeeder
{

    /**
     * Maakt nieuwe Pomodoro-modellen aan in de tabel `pomodori`.
     */
    public function run()
    {
        $userA = User::where('email', 'demo.gebruiker.a@arteveldehs.be')->first();
        $taskA = Task::where('user_id', $userA->id)->first();
        $taskB = Task::find(2);

        // DemoPomodoro A
        Pomodoro::create([
            'description' => 'DemoPomodoro A',
            'task_id'     => $taskA->id,
        ]);

        // DemoPomodoro B
        $pomodoroB = new Pomodoro();
        $pomodoroB->description = 'DemoPomodoro B';
        $pomodoroB->task()->associate($taskB);
        $pomodoroB->save();

        // DemoPomodoro C
        $pomodoroC = new Pomodoro();
        $pomodoroC->description = 'DemoPomodoro C';
        $pomodoroC->task()->associate($taskA);
        $pomodoroC->save();

    }

}
