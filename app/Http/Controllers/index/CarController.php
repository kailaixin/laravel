<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_goods;
use App\model\Index_car;
use DB;
class CarController extends Controller
{
	/**
	 * 购物车首页
	 * [index description]
	 * @return [type] [description]
	 */
    public function car(Request $request)
    {
    	$id = $request->id;
    	//查询有无登录
        $session = session('user');
     	if($session){
     			// 有
     		$this->carzeng($id);
     	}else{
     			//无
     	    return redirect('/login');
     	}

     	//查询购物车信息
     	$where=[
     		'reg_id'=>session('user')->reg_id,
     	];
     	$car = Index_car::where($where)->get();
     	// dd($car);

    	return view('index/car/car',compact('car'));
    }
 	/**
 	 * 增加购物车
 	 * [checklogin description]
 	 * @return [type] [description]
 	 */
     public function carzeng($id)
     {
        //实例化 memcache对象
     	// $memcache = New \Memcache;
      //   // dd($memcache);
      //   //链接服务
      //   $memcache->connect('127.0.0.1','11211');
      //   //正常使用
      //   //取值
      // $data = $memcache->get('CarController_caraeng_carinfo');
      // //判断$data 为空的话赋值
      //   if(empty($data)){
      //        $data =json_encode(DB::table('index_car')->get());
      //        //赋值
      //         $memcache->set('CarController_caraeng_carinfo',json_encode($data),0,10);
            
      //   }
        // dump($data);
        // //取值
     		$where =[
     			'reg_id'=>session('user')->reg_id,
     			'gid'=>$id
     		];
     		// dd($where);
     		$goods = Admin_goods::find($id)->toArray();
     		// dd($goods);
     		// 查看购物车表 有此信息更新购物数量 无 就新增
     		$car = Index_car::where($where)->count();
     		// $car_number = $car->car_number+1;
     		// dd($car);
     		if($car){
     			//更新
     			Index_car::where($where)->update(['car_number'=>1]);
     			redirect('index/car');
     			// echo "<script>alert('添加购物车成功');location.href={{url('index/car')}};</script>";
     		}else{
     			//新增
     			$array=[
     				'reg_id'=>session('user')->reg_id,
     				'gid'=>$goods['gid'],
     				'goods_name'=>$goods['goods_name'],
     				'shop_price'=>$goods['shop_price'],
     				'goods_img'=>$goods['goods_img'],
     				// 'car_number'=>$car_number,
     				'add_time'=>time(),
     			];
     			Index_car::where($where)->insert($array);
     			
               return  redirect('index/car');
     			// echo "<script>alert('加入购物车成功');location.href={{url('index/car')}};</script>";
     			
     		}
     }
     /**
      * 计算价格
      * [getMoney description]
      * @return [type] [description]
      */
     public function getMoney()
     {
            $reg_id = session('user')->reg_id;
            // dd($reg_id);
            $goods_ids = request()->vals;
            // 分割数组
            $goods_ids = implode(",", $goods_ids);
            // dd($goods_ids);
            if(!$goods_ids){
                 return number_format(0,2,'.','');
            }
            $total = 0;
           $total =DB::select("select sum(shop_price * car_number) as total from index_car where reg_id=$reg_id and car_id in ($goods_ids)");
            $price =json_decode(json_encode($total),true);
            $price = array_reduce($price, 'array_merge', array());
            $price = implode (',',$price);
            // dump($price);die;
            return $price;
     }  
//      Collection::macro('toUpper', function () {
//     return $this->map(function ($value) {
//         return strtoupper($value);
//     });
// });
     /**
      * 删除
      * [delete description]
      * @return [type] [description]
      */
     public function delete(Request $Request)
     {
     	$delid = $Request->delid;
     	// dd($delid);
     	$res = Index_car::destroy($delid);
        if($res){
            echo json_encode(['msg'=>'删除成功','code'=>'00000']);die;
        }else{
            echo json_encode(['msg'=>'删除失败','code'=>'00001']);die;
        }
       
       
     }
}
