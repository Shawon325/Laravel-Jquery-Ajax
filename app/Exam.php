<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exam_student';
    protected $fillable = ['id', 'name', 'department_id'];
}
