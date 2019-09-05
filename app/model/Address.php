<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $primaryKey = "add_id";
    protected $table = 'address';
    public $timestamps = false;
    public $fillable = ['shr','sheng','shi','xian','tel','reg_id'];
}
