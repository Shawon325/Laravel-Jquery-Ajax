<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teacher_info';
    protected $fillable = ['name' , 'department' , 'phone_number' , 'address'];
}
