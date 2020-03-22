<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    // protected $guarded = ['id'];
    protected $fillable= ['name','designation','gender','email','number','address'];

}
