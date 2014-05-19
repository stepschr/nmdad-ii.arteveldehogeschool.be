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
            'id'      => '1',
            'name'      => 'Onbelangrijk',
            'class'=>'onbelangrijk'
        ]);

        Prioriteit::create([
            'id'      => '2',
            'name'      => 'Minder Belangrijk',
            'class'=>'minder'
        ]);


        Prioriteit::create([
            'id'      => '3',
            'name'      => 'Normaal',
            'class'=>'normaal'
        ]);


        Prioriteit::create([
            'id'      => '4',
            'name'      => 'Belangrijk',
            'class'=>'hoog'
        ]);


        Prioriteit::create([
            'id'      => '5',
            'name'      => 'Heel Belangrijk',
            'class'=>'heelhoog'
        ]);

    }

}