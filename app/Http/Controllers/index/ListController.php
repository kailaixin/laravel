<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Admin_goods;
class ListController extends Controller
{
	/**
	 * 商品列表页
	 * [list description]
	 * @return [type] [description]
	 */ 
	
    public function list(Request $request)
    {
        $id = $request->id;
        // dd($id);
        // $orderby = $request->get('orderby');
        // dump($orderby);
       //  $where=[];
       //   if($orderby == 1){
       //  $where[]=['is_new','=',1];
       // }
       // if($orderby == 2){
       //  $where[]=['is_hot','=',1];
       // }
       // if($orderby == 3){
       //  $where[]=['is_on_sale','=',1];
       // }
       //接收搜索条件
        // $orderby = request()->orderby;
        // dd($data);
    	// 获取分类中的数据 2,排序
    	 $cat_info =DB::table('admin_cat')->get();

    	 $cat_info = CreateTree($cat_info,$parent_id=$id);
    	 // dd($cat_info);
    	 //从cat_info里取出一列
    	 $cids = array_column($cat_info,'cid');
    	 //把顶级分类id插入在cid前面
    	
    	// if($orderby==''){
     //         $goods = DB::table('admin_goods')->whereIn('cid',$cids)->get();
     //    }
    	 // 查出顶级分类下的所有商品
    	 $goods = DB::table('admin_goods')->whereIn('cid',$cids)->get();
    	 // dd($goods);
    	 return view('index/list/list',compact('goods'));
    }
    /**
     * ajax搜索
     * [sousuo description]
     * @return [type] [description]
     */
    public function sousuo()
    {
        
       // $orderby = ['is_new'=>1,'is_hot'=>2,'is_on_sale'=>3];
      
       // 获取分类中的数据 2,排序
         // $cat_info =DB::table('admin_cat')->get();
         // $cat_info = CreateTree($cat_info);
         // // dd($cat_info);
         // //从cat_info里取出一列
         // $cids = array_column($cat_info,'cid');
         // //把顶级分类id插入在cid前面
         // array_unshift($cids,$id);
         // // dd($cids);
        
         // // 查出顶级分类下的所有商品
         // $goods = DB::table('admin_goods')->whereIn('cid',$cids)->where($where)->get();
         // dd($goods);
         
        // dd($orderby);
    }
   
    /**
     * 商品详情页
     * [xiangqing description]
     * @return [type] [description]
     */
    public function xiangqing($id)
    {
        $goods_data=Admin_goods::find($id);
        // dd($goods_data);
    	return view('index/list/xiangqing',compact('goods_data'));
    }
}
