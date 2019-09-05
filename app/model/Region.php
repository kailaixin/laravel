<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $primaryKey = 'region_id';
    protected $table = 'region';
    public $timestamps = false;
    public static function getAddressName($region_id)
    {
    	$name = self::where('region_id',$region_id)->value('region_name');
    	//dd($name);
    	return $name;
    }
}
