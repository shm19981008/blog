<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods_admin extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'goods_admin';
    protected $guarded=[];
    public $timestamps=false;
}
