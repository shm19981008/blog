<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $primaryKey = 'cate_id';
    protected $table = 'cate';
    protected $guarded=[];
    public $timestamps=false;
}
