<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'cart';
    protected $guarded=[];
    public $timestamps=false;
}
