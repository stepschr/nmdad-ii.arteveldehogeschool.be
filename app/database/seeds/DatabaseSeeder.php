<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('UserTableSeeder');
        $this->call('AdminTableSeeder');
        $this->call('LabelTableSeeder');
        $this->call('TaskTableSeeder');
        $this->call('PomodoroTableSeeder');
        $this->call('LabelPomodoroTableSeeder');
	}

}
