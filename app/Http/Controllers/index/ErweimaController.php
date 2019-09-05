<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ErweimaController extends Controller
{
	/**
	 * 生成二维码
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	return view('index/erweima/index');
    }
}
