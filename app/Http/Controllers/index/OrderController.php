<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Address;
use App\model\Region;
use DB;
class OrderController extends Controller
{
	/**
	 * 订单首页
	 * [order description]
	 * @return [type] [description]
	 */
    public function order()
    {
        $goods_id = request()->ids;
    
        $count = Address::count();
       
        $reg_id = session('user')->reg_id;
        // dd($reg_id);
        if(!$reg_id){
            redirect('index/login');
        }
        $car_id = request()->input();
        // dd($car_id );
       $car_id = implode(',', $car_id);
       $car_id = explode(',', $car_id);
       $car_ids = implode(',',$car_id);
       // dd($car_ids);
         $address = Address::where(['is_show'=>1,'reg_id'=>$reg_id])->first()->toArray();
         
         $region = DB::table('region')->get()->toArray();
         //dump($region);
         foreach ($region as $k => $v) {
            //dump($v->region_id);
             if($address['zhong']==$v->region_id){
                $address['zhong']=$v->region_name;
             };
             if($address['sheng']==$v->region_id){
                $address['sheng']=$v->region_name;
             };
             if($address['shi']==$v->region_id){
                $address['shi']=$v->region_name;
             };
             if($address['xian']==$v->region_id){
                $address['xian']=$v->region_name;
             };
         };
         // dump($address['zhong']);
         // dump($address);
           $total =DB::select("select sum(shop_price * car_number) as total from index_car where reg_id=$reg_id and car_id in ($car_ids)");
           // 
            // $total = http_build_query($total);
            $price =json_decode(json_encode($total),true);
                // dd($total);
            $price = array_reduce($price, 'array_merge', array());
            $price = implode (',',$price);
        // var_dump($price);
            // 循环出省市区

        $data = DB::table('index_car')->whereIn('car_id',$car_id)->get();
    	return view('index/order/order',compact('data','count','address','price','goods_id'));
    }
    /**
     * 收货地址
     * [order description]
     * @return [type] [description]
     */
     public function address()
    {
        $reg_id = session('user')->reg_id;
        // dump($reg_id);
    	$top = DB::table('region')->where('parent_id',0)->get()->toArray();
    	// dd($top);
        // $address = DB::table('address') 
    	return view('index/order/address',compact('top'));
    }
    /**
     * 四级联动
     * [address_do description]
     * @return [type] [description]
     */
    public function address_do()
    {
        //四级联动
    	$parent_id = request()->post();
    	if(!$parent_id){
    		return;
    	}
    	// dd($parent_id);
    	$region = DB::table('region')->where('parent_id',$parent_id)->get();
    	// dd($region);
    	echo json_encode($region);
    }
    /**
     * 添加收货人
     * [save description]
     * @return [type] [description]
     */
    public function save()
    {
        $reg_id = session('user')->reg_id;
        $post = request()->except('_token');
        $post['reg_id']=$reg_id;
        // dd($post);
        //验证
        //入库
        $res = Address::insert($post);
        // dd($res);
        if($res){
            redirect('index/add_address');
        }
    }
    public function add_address()
    {
        return view('index/order/add_address');
    }
     /**
     * 支付方式
     * [paymode description]
     * @return [type] [description]
     */
    public function paymode()
    {

        $order = request()->all();
        dump($order); 
        
    }
}
