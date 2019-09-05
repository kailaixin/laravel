<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\Brand;
use Illuminate\Validation\Rule;
use Validator;
use DB;
class BrandController extends Controller
{
    public function brand()
    {
        return view('admin/brand/brand_add');
    }
    public function brand_do()
    {
        request()->validate([
            'brand_name' => 'required|unique:brand|max:50',
            'brand_url' => 'required',
            'brand_order' => 'required|numeric',
            'brand_desc' => 'required',
        ],[
            'brand_name.required'=>'品牌不能为空',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_name.max'=>'品牌名称最大不能超过50',
            'brand_url.required'=>'品牌网址必填',
            'brand_order.required'=>'排序必填',
            'brand_order.numeric'=>'排序必须是数字',
            'brand_desc.required'=>'描述必填',
        ]);
        $post=request()->except('_token');
        // dd($post);
        //判断有文件上传
        if(request()->hasFile('brand_logo')){
            //调用公共方法的文件上传
            $post['brand_logo'] = files('brand_logo');
        }
        // dd($post);
        $stu = DB::table('brand')->insert($post);
        if($stu){
            return redirect("admin/brand_list");
        }
    }
    public function brand_list()
    {
        //接收列表传的搜索数据
        $query = Request()->input();
        // dd($query);
        $brand_name=$query['brand_name']??"";
        $is_show=$query['is_show']??"";
        $where=[];
        if($brand_name){
            $where[]=['brand_name','like','%'.$brand_name.'%'];
        }
        if($is_show || $is_show==='0'){
            $where[]=['is_show','=',$is_show];
        }
        $data=DB::table('brand')->where($where)->orderby('brand_order','desc')->paginate('2');
        return view('admin/brand/brand_list',compact(['data','brand_name','is_show']));
    }
    /**
     * 品牌删除
     * [goods_delete description]
     * @return [type] [description]
     */
     public function brand_delete()
     {
        $brand_id=request()->input('brand_id');
        // dd($brand_id);
        $res=DB::table('brand')->where('brand_id',$brand_id)->delete();
        // return redirect('admin/goods_list');
        if($res){
            return json_encode(['ret'=>1,'msg'=>'删除成功']);die;
        }else{
            return json_encode(['ret'=>0,'msg'=>'删除失败']);die;
        }
    }
    /**
     * 品牌的编辑
     * [brand_exit description]
     * @return [type] [description]
     */
    public function brand_exit($id)
    {
        // 
       $data = Brand::find($id);
        // dump($data);
        
        return view('admin/brand/brand_exit',['data'=>$data]);
    }
    /**
     * 执行修改
     * [update description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function brand_update($id)
    {
        // dump($id);
        //接收
        $data = request()->except('_token');
        // dump($data);
        //验证
         $validator = Validator::make($data, [
                 'brand_name'=>[
                        'required',
                        Rule::unique('brand')->ignore($id,'brand_id'),
                        'max:30',
                  ],
                 // 'b_name' => 'required|unique:crm_banner|max:255',
                 'brand_url' => 'required',
                  'brand_order' => 'required|numeric',
                  'brand_desc' => 'required',
             ],[
                'brand_name.required' =>'品牌名称不能为空',
                'brand_name.unique' =>'品牌名称已存在',
                'brand_url.required'=>'品牌url地址不能为空',
                 // 'brand_name.required'=>'品牌不能为空',
                // 'brand_name.unique'=>'品牌名称已存在',
                'brand_name.max'=>'品牌名称最大不能超过50',
                // 'brand_url.required'=>'品牌网址必填',
                'brand_order.required'=>'排序必填',
                'brand_order.numeric'=>'排序必须是数字',
                'brand_desc.required'=>'描述必填',
             ]);
                 if ($validator->fails()) {
                 return redirect('/admin/brand_exit/'.$id)
                 ->withErrors($validator)
                ->withInput();
         }
         if (request()->hasFile('brand_logo')) {
                $data['brand_logo'] = files('brand_logo');
            }
            // dd($data);
            $res = Brand::where('brand_id',$id)->update($data);
            if($res){
              echo "<script>alert('修改成功');location.href='/admin/brand_list';</script>";die;
        }else{
             echo "<script>alert('修改失败');location.href='/admin/brand_exit';</script>";die;
        }
     
    }
    
}
