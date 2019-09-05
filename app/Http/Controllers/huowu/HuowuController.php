<?php

namespace App\Http\Controllers\huowu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class HuowuController extends Controller
{
	//登录 
     public function login()
     {
     	return view('huowu/login');
     }
     //登录处理
     public function login_do()
     {
     	$post = request()->except('_token');
     	$name = $post['name'];
     	$pwd = $post['pwd'];
     	// dd($pwd);
     	$data = DB::table('login')->where('name',$name)->first();
     	$data = json_decode(json_encode($data),true);
     	// dd($data);
     	if($data['name'] != $name){
     		echo "<script>alert('用户名不正确');location.href='login';</script>";die;
     	}
     	if($data['pwd'] != $pwd){
     		echo "<script>alert('密码不正确');location.href='login';</script>";die;
     	}
     	if($data['pwd'] == $pwd){
     				request()->session()->put('user',$data);
                request()->session()->save();
     		echo "<script>alert('登录成功');location.href='ruku';</script>";die;
     	}
     }
     // 入库页面
     public function ruku()
     {
     	return view('huowu/ruku');
     }
     //入库处理
     public function save()
     {
     	$u_id = session('user')['u_id'];
     	// dd($u_id);
     	$post = request()->except('_token');
     	$post['add_time']=time();
     	$post['u_id']=$u_id;
     	
     	//判断有文件上传
        if(request()->hasFile('img')){
            //调用公共方法的文件上传
            $post['img'] = files('img');
        }
   
        $stu = DB::table('huowuruku')->where('u_id',$u_id)->insert($post);
       
        if($stu){
           echo "<script>alert('入库成功');location.href='index';</script>";die;
        }
     }
     //展示页面
     public function index()
     {
     	$data = DB::table('huowuruku')->get()->toArray();
     	$data = json_decode(json_encode($data),true);
     	// dd($data);
     	return view('huowu/index',compact('data'));
     }
     //出库
     public function chu()
     {
     	$id = request()->id;
     	$data = DB::table('huowuruku')->where('huowu_id',$id)->get();
     	$data = json_decode(json_encode($data),true);
     	// dd($data);
     	return view('huowu/chu',compact('id','data'));
     }

      //出库处理
     public function chu_do()
     {
     	$id = request()->id;
     	$name = request()->name;
     	$number = request()->number;
     	$datas = DB::table('huowuruku')->where('huowu_id',$id)->get();
     	$datas = json_decode(json_encode($datas),true);
     	// dump($name);
     	// dd($datas);
     	if($datas[0]['number']<$number){
     		 echo "<script>alert('库存不足');location.href='chu';</script>";die;
     	}
     	$data = DB::table('churuku')->where(['u_id'=>session('user')['u_id']])->insert(['huowu_id'=>$id,'chuku_number'=>$number,'chuku_name'=>$name,'chu_time'=>time(),'type'=>"出库"]);
     	if($data){
     		 echo "<script>alert('出库成功');location.href='index';</script>";die;
     	}
     }


      //入库
     public function ru()
     {
     	$id = request()->id;
     	$data = DB::table('huowuruku')->where('huowu_id',$id)->get();
     	$data = json_decode(json_encode($data),true);
     	return view('huowu/ru',compact('id','data'));
     }
     //入库处理
     public function ru_do()
     {
     	$id = request()->id;
     	$name = request()->name;
     	$number = request()->number;
     	$time = time();
     	// dump($number);
     	// dump($name);
     	// dump($id);
     	$where=[
     		'huowu_id'=>$id,
     		'u_id'=>session('user')['u_id'],
     	];
     	// 入库
     	$data = DB::table('huowuruku')->where($where)->update(['number'=>$number,'add_time'=>$time]);
     	$cate = DB::table('churuku')->where($where)->insert(['huowu_id'=>$id,'ruku_number'=>$number,'ruku_name'=>$name,'add_time'=>time(),'type'=>"入库"]);
     	// dd($data);
     	 echo "<script>alert('入库成功');location.href='index';</script>";die;
     }
}
