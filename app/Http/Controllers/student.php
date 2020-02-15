<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class student extends Controller
{
    public function index()
    {
    	$a=DB::table('student')->get()->toArray();
		echo "<pre>";
		print_r($a);
    }
}
