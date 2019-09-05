<?php

namespace App\Http\Controllers\index;
use APP\Http\Controllers\MailController;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Cookie;

class RegController extends Controller
{
	/**
	 * 注册
	 * [reg description]
	 * @return [type] [description]
	 */
    public function reg()
    {
        $code = request()->session()->get('code');
//echo $code;die;
    	return view('index/reg/reg');
    }
    /**
     * 接收邮箱
     * [reg_do description]
     * @return [type] [description]
     */
    public function send()
    {
    	$email = request()->email;
    	// dd($email);
    	// 验证 邮箱是否为空 格式是否正确
    	$reg='/^\w+@\w+\.com$/';
    	if(empty($email)){
    		echo json_encode(['msg'=>'邮箱不能为空','code'=>'00001']);die;
    	}else if(!preg_match($reg,$email)){
    		echo json_encode(['msg'=>'邮箱格式不正确','code'=>'00002']);die;
    	}
    	$code = rand(100000,999999);
    	// // dd($code);
       $info = "欢迎来到本公司注册注册账号";
       // $body = "您的验证码是".$code;
       //调用邮箱方法
       
    	 $this->sends($email,$info,$code);
         
        request()->session()->put('code',$code);
        request()->session()->save();
    	echo json_encode(['msg'=>'发送成功','code'=>'00000']);die;

    }
    function sends($email,$info,$code)
    {
        //echo $info;die;
        \Mail::send('mail' , ['name'=>$email,'code'=>$code] ,function($message)use($email,$info){
           // echo $info;die;
        //设置主题
            $message->subject($info);
        //设置接收方
            $message->to($email);
        });
        // request()->session()->put('code', '1231231');
    }

    /**
     * 注册处理
     * [reg description]
     * @return [type] [description]
     */
     public function reg_do()
    {
    	$post = request()->except('_token');
    	$post['reg_time'] = time();
    	$post['reg_pwd'] = md5($post['reg_pwd']);
        // dump($post);
    	// 验证
    	$validator = Validator::make($post, [
			 'reg_name' => 'required|unique:index_reg|max:25',
			 'reg_pwd' => 'required',
			 'reg_pwd2' => 'required',
		 ],[
		 	'reg_name.required' => "手机号码或邮箱必填",
		 	'reg_name.unique' => "用户名已存在",
		 	'reg_name.max' => "用户名最大25个字符",
		 	'reg_pwd.required'=>'请输入密码',
		 	'reg_pwd2.required'=>'请输入确认密码密码',
		 ]);
			 if ($validator->fails()) {
			 return redirect('index/reg')
					 ->withErrors($validator)
					->withInput();
		 }
		 unset($post['reg_pwd2']);
         $code = session('code');
         // dump($code);
         if ($code != $post['reg_code']) {
              echo "<script>alert('验证码不正确');location.href='/index/reg';</script>";die;
         }
          unset($post['reg_code']);
    	// 入库
    	$res = DB::table('index_reg')->insert($post);
    	// dd($res);
        if($res){
            echo "<script>alert('恭喜你注册成功');location.href='index/index';</script>";die;
        } else{
            echo "<script>alert('很遗憾注册失败');location.href='index/reg';</script>";die;
        }
    }
    
}
