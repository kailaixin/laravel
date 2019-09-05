<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;
class Index_car extends Model
{
    protected $primaryKey = "car_id";
    protected $table = "index_car";
    public $timestamps = false;
    
}
