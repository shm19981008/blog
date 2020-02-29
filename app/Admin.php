<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'admin_id';
    protected $table = 'admin';
    protected $guarded=[];
    public $timestamps=false;
}
