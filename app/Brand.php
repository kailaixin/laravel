<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
   protected $primaryKey = "brand_id";
   protected $table = "brand";
   public $timestamps = false;

}
