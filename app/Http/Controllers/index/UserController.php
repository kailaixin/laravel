<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	/**
	 * 用户页
	 * [user description]
	 * @return [type] [description]
	 */
    public function user()
    {
    	return view('index/user/user');
    }
    /**
     * 用户地址
     * [user description]
     * @return [type] [description]
     */
    public function user_address()
    {
    	return view('index/user/user_address');
    }
}
