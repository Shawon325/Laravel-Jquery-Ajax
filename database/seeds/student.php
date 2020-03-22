<?php

use Illuminate\Database\Seeder;

class student extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = array();

    	for($i=0; $i<5000; $i++) 
    	{ 
    		$data[] = [
		            'student_name' => Str::random(10),
		            'phone_number' => rand(),
		            'status' => Str::random(10)
		        ];
       	}
       	DB::table('student')->insert($data);
        
    }
}
