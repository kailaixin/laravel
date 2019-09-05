<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Index_Reg;
use DB;

class LoginController extends Controller
{
	/**
	 * 登录页面
	 * [login description]
	 * @return [type] [description]
	 */
    public function login()
    {
    	return view('index/login/login');
    }
    /**
     * 登录处理页面
     * [login_do description]
     * @return [type] [description]
     */
    public function login_do()
    {
    	$reg_name = request()->reg_name;
    	$reg_pwd = md5(request()->reg_pwd);
     	// dd($reg_name);
     	
     	$user = DB::table('index_reg')->where('reg_name','=',$reg_name)->first();
     	// dd($data);
     	if(!$user){
     		echo "<script>alert('用户名不存在');location.href='/login'</script>";die;
     	}else if($user->reg_pwd != $reg_pwd){
     		echo "<script>alert('密码不正确');location.href='/login'</script>";die;
     	}else{
     			 request()->session()->put('user',$user);
                request()->session()->save();
     		echo "<script>alert('恭喜您登录成功');location.href='/index/index'</script>";die;
     	}
     	
     	
    }

    public function weixinlogin()
    {
       //第一步 用户同意授权 获取code码
       //跳转回调
    // echo 1231;
       $redirect_uri = "http://www.laravelw.com/code";
       $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('APPID')."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
       header('location:'.$url);

    }

    public function code()
    {
        //第二步 接收 code  通过code 获取网页授权码
        $code = request()->all();
        // dd($code); 
        $res = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('APPID').'&secret='.env('APPSECRET').'&code='.$code['code'].'&grant_type=authorization_code');
        $res = json_decode($res,1);
        // dd($res);
        //第三步  获取 access_token 
        $user_info = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='.$res['access_token'].'&openid='.$res['openid'].'&lang=zh_CN');
        $user_info = json_decode($user_info,1);
        dd($user_info);

        
    }

   
}
