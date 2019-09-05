<?php

namespace App\Http\Controllers\index;
use App\Admin_goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
	/**
	 * 前台首页
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
        // Redis::set('user','开来鑫');
        // $name = Redis::get('user');
        // dd($name);

      //获取上架 8 条数据
      $page = config('app.page');
    	$is_on_sale=Admin_goods::where(['is_on_sale'=>1])
                          ->join('admin_cat','admin_goods.cid','=','admin_cat.cid')
                          ->join('brand','brand.brand_id','=','admin_goods.brand_id')
    	                   ->paginate($page);
                         // dump($is_on_sale);
     //获取3条精品数据
     $is_hot=Admin_goods::where(['is_hot'=>1])
                          ->join('admin_cat','admin_goods.cid','=','admin_cat.cid')
                          ->join('brand','brand.brand_id','=','admin_goods.brand_id')
                         ->paginate(3);
                         // dd($is_hot);
    	//获取总商品数
    	$count = DB::table('admin_goods')->count();
    	// 获取顶级分类
    	$top_name = DB::table('admin_cat')->where('parent_id','=','0')->get()->toArray();
      // dd($top_name);
     
    	//获取全部分类信息
    	$cate = DB::table('admin_cat')->get();
    	// 调用递归方法进行排序
    	$cate = CreateTree($cate);
    	// dd($cate);
    	
    	
    	return view('index/index',compact('count','top_name','is_on_sale','cate','is_hot'));
    }
     /**
     * 楼层关系 方法
     * [getfloor description]
     * @param  [type] $cat_id [description]
     * @return [type]         [description]
     */
    public function getfloor($cid)
    {
       // 获取二级分类
        $second_cat = DB::table('admin_cat')->where(['parent_id','=',$cid])->get();
        // dump($second_cat);die;
        // 根据大分类获取商品 转成数组形式
        // 获取当前大分类下的所有子分类
        $data=DB::table('admin_cat')->get()->toArray();
        //$cat_ata=CatModel::all()->toArray();
        //查询当前分类下的所有子分类 进行排序
        $cat_data=CreateTree($data,$cid);
        //$cat_data=createTree($data);
         // dump($cat_data);die;
         // 只取cat_id 这一列的数据
        $cat_data=array_column($cat_data,"cid");
        // dump($cat_data);
        // 把$cat_id 追加进去 组合当前所有的分类
        array_unshift($cat_data,$cid);
        // dump($cat_data);
        // 获取商品信息
        $where = [
            ['cid','in',$cat_data],
        ];
        // dump($where);
        // 根据where条件 查找分类下的子类的商品信息
        $goods=DB::table('admin_goods')->where($where)->get()->toArray();
            // 返回二级分类 和商品的信息
         return ['second_cat'=>$second_cat,'goods'=>$goods];

      
    }
}
