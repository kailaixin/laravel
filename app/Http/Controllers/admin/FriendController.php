<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\FriendModel;
use DB;


class FriendController extends Controller
{
    public function friend()
    {
        $friend=DB::table('friend')->get();
        // dump($admin_friend);die;
        // $friend=CreateTree($friend);
        return view('admin/friend/friend_add',['friend'=>$friend]);
    }

     public function friend_do()
    {
    	// echo 123;
        $validator=Validator::make(request()->all(), [
            'w_name' => 'required|unique:friend',
            'w_site' => 'required',
            'w_tel' => 'required|numeric',
            'w_desc' => 'required',
        ],[
            'w_name.required'=>'网站不能为空',
            'w_name.unique'=>'网站名称已存在',
            'w_site.required'=>'网站网址必填',
            'w_tel.required'=>'网站联系人必填',
            'w_tel.numeric'=>'网站联系人必须是数字',
            'w_desc.required'=>'网站介绍必填',
        ]);
        if ($validator->fails()) {
            return redirect('friend')
            ->withErrors($validator)
            ->withInput();
            }
        $data=request()->except('_token');
        // dump($data);die;
        if(request()->hasFile('w_logo')){
            $data['w_logo']=$this->files('w_logo');
        }
        $res=DB::table('friend')->insert($data);
        // dump($res);die;
        if($res){
            return redirect('friend_list');
        }
    }
    // 上传图片的方法
    public function files($name)
    {
        if ( request()->file($name)->isValid()) {
            $photo = request()->file($name);
            $store_result = $photo->store('', 'public');
           return $store_result;
        }
    }

    //展示
    public function friend_list()
    {
        $page=config('app.page');
        $query=Request()->input();
        // dd($query);die;
        $w_name=$query['w_name']??"";
        $where=[];
        if($w_name){
            $where[]=['w_name','like','%'.$w_name.'%'];
        }
        $data=DB::table('friend')->where($where)->paginate($page);
        return view('admin/friend/friend_list',compact('data','query','w_name'));
	}

	// 修改
    public function friend_exit($w_id)
    {
        $data=FriendModel::find($w_id);
        return view('admin/friend/friend_exit',['data'=>$data]);
    }
    public function friend_update($w_id)
    {
    	// echo 123;
        $validator=Validator::make(request()->all(), [
            'w_name' => 'required|unique:friend',
            'w_site' => 'required',
            'w_tel' => 'required|numeric',
            'w_desc' => 'required',
        ],[
            'w_name.required'=>'网站不能为空',
            'w_name.unique'=>'网站名称已存在',
            'w_site.required'=>'网站网址必填',
            'w_tel.required'=>'网站联系人必填',
            'w_tel.numeric'=>'网站联系人必须是数字',
            'w_desc.required'=>'网站介绍必填',
        ]);
        if ($validator->fails()) {
            return redirect('friend_exit/'.$w_id)
            ->withErrors($validator)
            ->withInput();
            }
        $data=request()->except('_token');
        if(request()->hasFile('w_logo')){
            $data['w_logo']=$this->files('w_logo');
        }
        $res=FriendModel::where('w_id','=',$w_id)->update($data);
        return redirect('friend_list');
    }
    public function friend_delete()
    {
        $w_id=request()->input('w_id');
        $res=DB::table('friend')->where('w_id',$w_id)->delete();
        // return redirect('admin/goods_list');
        if($res){
            return json_encode(['ret'=>1,'msg'=>'删除成功']);die;
        }else{
            return json_encode(['ret'=>0,'msg'=>'删除失败']);die;
        }
    }
}
