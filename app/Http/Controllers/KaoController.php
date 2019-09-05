<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redis;
class KaoController extends Controller
{
    public function login()
    {
    	return view('login');
    }

    public function logindo()
    {
    	$post = request()->except('_token');
    	// dd($post);
    	$name = $post['name'];
    	$pwd = $post['pwd'];
    	// dump($name);
    	// dump($pwd);
    	$data = DB::table('login')->where('name',$name)->first();
    	$data = json_decode(json_encode($data),true);
    	// dd($data);
    	if($name!=$data['name']){
    		echo "<script>alert('用户名不存在');location.href='login';</script>";die;
    	}
    	
    	if($pwd!=$data['pwd']){
    		echo "<script>alert('密码不正确');location.href=('login');</script>";die;
    	}
    	if($pwd == $data['pwd']){
    		 request()->session()->put('user',$data);
                request()->session()->save();
    		echo "<script>alert('登录成功');location.href=('add');</script>";die;
    	}
    }

    public function add()
    {
    	return view('add');
    }
    public function save()
    {
    	// 接收
    	$post = request()->except('_token');
    	$post['add_time']=time();    	
    	$post['u_id']=session('user')['u_id'];


    	// 验证
    	// 入库
    	$data = DB::table('add')->insert($post);
    	if($data){
    		echo "<script>alert('添加成功');location.href=('index');</script>";die;
    	}else{
    		echo "<script>alert('添加失败');location.href=('add');</script>";die;

    	}
    }

    public function index()
    {	
    	$session=request()->session()->get('user');
    	// echo Redis::get('dianzan');
    	$data = DB::table('add')->get();
    	$data=json_decode(json_encode($data),true);
        // dd($data);
    	$rela = DB::table('dianzan')->where(['u_id' => session('user')['u_id']])->get();
    	$rela = json_decode(json_encode($rela),true);
    	$dianzan = array_column($rela, 'w_id');
    	foreach($data as $key => $val) {
            $v = Redis::get('dianzan' . $val['w_id']);
            $data[$key]['dian'] = empty($v) ? 0 : $v;


            $data[$key]['flag'] = in_array($val['w_id'], $dianzan) ? '取消点赞' : '点赞';
        }

        //dump($data);
        return view('index',compact('data','session'));
    	//return view('index',compact('data'));
    }

    public function list()
    {
        $id = request()->id;
        // dd($id);
    	$data = DB::table('add')->where('w_id',$id)->get()->toArray();
    	return view('list',compact('data'));
    }

    public function give()
    {
    	// 接收
    	$id = request()->id;
    	// $u_id = request()->u_id;
    	$flay = request()->flay;
    	$number = request()->number;
    	//dd($number);
    	// $number=0;
    	 if ($flay == '0'){
            // Redis::incr('dianzan' . $id);
            // 新增点赞关系
            DB::table('dianzan')->insert(['u_id' => session('user')['u_id'], 'w_id' => $id]);
            DB::table('add')->where(['w_id'=>$id])->update(['number'=>$number+1]);
            $number=DB::table('add')->where(['w_id'=>$id])->get()->toArray();
            $number = json_decode(json_encode($number),true);
        } else {
            // Redis::decr('dianzan' . $id);
            // 删除点赞关系
             DB::table('dianzan')->where(['u_id' => session('user')['u_id'], 'w_id' => $id])->delete();
            DB::table('add')->where(['w_id'=>$id])->update(['number'=>$number-1]);
            $number=DB::table('add')->where(['w_id'=>$id])->get()->toArray();
            $number = json_decode(json_encode($number),true);
        }
        //$number[0]['number'];
        return json_encode(['number'=>$number[0]['number'],'id'=>$number[0]['w_id']]);die;
    	
    
    	
    }
}
