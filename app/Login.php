<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    
    protected $table = 'user';
    protected $guarded=[];
    public $timestamps=false;
}
