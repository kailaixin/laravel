<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Index_Reg extends Model
{
    protected $primaryKey = "reg_id";
    protected $table = "index_reg";
    protected $fillable = "reg_name,reg_pwd,reg_time";
}
