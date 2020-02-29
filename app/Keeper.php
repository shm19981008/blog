<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keeper extends Model
{
    
    protected $table = 'keeper';
    protected $guarded=[];
    public $timestamps=false;
}
