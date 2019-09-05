<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class LoginController extends Controller
{
    // 登陆
    public function login()
    {
        return view('admin/login');
    }
    // 登陆执行
    public function login_do()
    {
        $data=request()->except('_token');
        $res=DB::table('admin_user')->where('uname','=',$data['uname'])->first();
        // dd($res);
        if(!$res){
            // echo 123;
            return redirect('login');
        }else{
            $data['upwd']=md5($data['upwd']);
            if($data['upwd']!=$res->upwd){
                return redirect('login');
            }else{
                //登录信息存到session
                request()->session()->put('user',$res);
                return redirect('admin/index');
            }
        }
        

    }
    // 销毁session
    public function login_del()
    {
        request()->session()->put('user',null);
        return redirect('login');
    }
}
