<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_ajax extends Model
{
    protected $table = 'student_ajaxes';
    protected $guarded = ['id'];
}
