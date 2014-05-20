<?php

class PrioriteitTableSeeder extends DatabaseSeeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        Prioriteit::create([
            'id'    => '1',
            'name'  => 'Onbelangrijk',
            'class' =>   'laag'
        ]);


        Prioriteit::create([
            'id'      => '2',
            'name'    => 'Normaal',
            'class'   => 'normaal'
        ]);


        Prioriteit::create([
            'id'      => '3',
            'name'    => 'Belangrijk',
            'class'   => 'hoog'
        ]);



    }

}