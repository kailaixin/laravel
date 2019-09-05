<?php

namespace App\Http\Controllers\kaoshi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class BallController extends Controller
{
    public function add()
    {
    	return view('/kaoshi/add');
    }
    public function save()
    {
    	//接收
    	$post = request()->except('_token');
  		//入库
    	$res = DB::table('ball')->insert($post);
    // dd($jingcai);
    	return redirect('ball/kaoshi/index');
    }

    public function index()
    {
    	$data = DB::table('ball')->get()->toArray();
    	// $time = DB::table('ball')->where('time',)
    	$data = json_decode(json_encode($data),true);
    	// $time = $data[0]['time'];
    	// dump($time);
    	return view('/kaoshi/index',compact('data'));
    }

    public function jieguo()
    {
    	// echo 123;
    	$id = request()->id;
    	// $ball_id = request()->id;
    	// dd($id);
    	
    	$data = DB::table('ball')->where('ball_id',$id)->get()->toArray();
    	$jieguo = DB::table('duqiu')->where('ball_id',$id)->get()->toArray();
    	$data = json_decode(json_encode($data),true);
    	$jieguo = json_decode(json_encode($jieguo),true);
    	// dump($jieguo);
    	// dump($data);
    	return view('/kaoshi/jieguo',compact('data','jieguo'));
    }

    public function jingcai()
    {
    	$id = request()->id;
    	$data = DB::table('ball')->where('ball_id',$id)->get()->toArray();
    	$data = json_decode(json_encode($data),true);
    	return view('/kaoshi/jingcai',compact('data','id'));
    }

    public function kongzhi()
    {
    	$id=request()->id;
    	// dump($id);
    	$data = DB::table('ball')->where('ball_id',$id)->get()->toArray();
    	// dump($data);
    	return view('/kaoshi/kongzhi',compact('data','id'));
    }
    //竞猜选项入库
    public function insert()
    {
    	$jingcai = request()->except('_token');
    	// $kongzhi = request()->kongzhi;
    	// dd($jingcai);
    	// 验证
    	// 入库
    	$res = DB::table('duqiu')->insert($jingcai);
    	// dd($res);
    	echo "<script>alert('竞猜成功');location.href=('index');</script>";
    }
    public function create()
    {
    	$id = request()->ball_id;
    	$kongzhi = request()->kongzhi;
    	// dd($kongzhi);
    	//入库
    	$data = DB::table('duqiu')->where('ball_id',$id)->insert(['kongzhi'=>$kongzhi,'ball_id'=>$id]);
    	echo "<script>alert('竞猜结果');location.href=('index');</script>";

    }

}
