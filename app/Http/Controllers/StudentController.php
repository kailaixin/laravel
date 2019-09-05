<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class StudentController extends Controller
{
	//添加
    public function add()
    {
    	
    	// echo 123;
    	return view('add');
    }
    // 处理
     public function save()
    {
    	// echo 1232;
    	// 接收
    	$post = request()->except('_token');
    	// dd($post);
    	//验证
    	//入库
    	$res = DB::table('stu')->insert($post);
    	// dump($res);
    	if($res){
    	  return	redirect('student/index');
    	}else{
    	return	redirect('student/add');
    	}
    }
    //展示
    public function index()
    {
    	// echo $php_info;
    	//查询
    	$data = DB::table('stu')->where(['status'=>1])->get()->toArray();
    	// dd($data);
    	return view('index',compact('data'));
    }
    //删除
    public function delete($id)
    {
    	// echo $id;
    	//查询
    	$res = DB::table('stu')->delete($id);
    	// dd($res);
    	if($res){
    		return redirect('student/index');
    	}else{
    	 return	redirect('student/index');
    	}
    }
    //即点即改
    public function jidian()
    {
    	// echo 123;
    	$id = request()->id;
    	$val = request()->val;
    	$field = request()->field;
    	// dump($post);
    	$info=[
    		$field=>$val
    	];
    	// dd($info);
    	$res = DB::table('stu')->where('id',$id)->update($info);
    	// dd($res);
    }
    //改变状态
    public function change()
    {
    	$value = request()->value;
    	$id = request()->id;
    	// dump($id);
    	$res = DB::table('stu')->where('id',$id)->update(['status'=>$value]);
    	// dd($res);
    }
}
