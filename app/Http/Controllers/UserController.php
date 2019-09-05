<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class UserController extends Controller
{
    public function index()
    {
    	Cookie::queue('author', '学院君', 12);
    }
    public function admin()
    {
    	$value = request()->cookie('author');
    	dd($value);
    }
}
