<?php

use Illuminate\Database\Seeder;
use App\Topic;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('topics')->insert([
    		'topic' => 'technology',
    		'topic' => 'science',
    		'topic' => 'mathematics',
    		'topic' => 'software'
    	]);

    }
}
