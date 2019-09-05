<!DOCTYPE html>
<html lang="zh-cn">
  <head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="/index/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond./index/js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <form action="{{url('paymode')}}" method="post">
  <!-- <input type="hidden" name="goods_id" value="{{$goods_id}}"> -->
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <div class="dingdanlist" ">
      <table>
       <tr>
       @if($count=="")
        <td class="dingimg" width="75%" colspan="2" onClick="window.location.href='{{url('index/address')}}'>新增收货地址</td>
        <td align="right"><img src="/index/images/jian-new.png" /></td>
        @else
              <td width="50%">
         <h3>{{$address['shr']}} {{$address['tel']}}</h3>
         <time>{{$address['sheng']}}&nbsp;&nbsp;&nbsp;{{$address['shi']}}&nbsp;&nbsp;&nbsp;{{$address['xian']}}{{$address['xiangxi']}}</time>
        </td>
         @endif
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">选择收货时间</td>
        <td align="right"><img src="/index/images/jian-new.png" /></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="85%" colspan="2">支付方式</td>
      </tr>
      <tr>
        <td align="right"><span order="1" class="hui orange pay">银行卡支付</span></td>
        <td align="center"><span order="2" class="hui  pay">支付宝支付</span></td>
        <td align="left"><span order="3" class="hui  pay">微信支付</span></td>
       </tr>
        
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">优惠券</td>
        <td align="right"><span class="hui">无</span></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">是否需要开发票</td>
        <td align="right"><a href="javascript:;" class="orange">是</a> &nbsp; <a href="javascript:;">否</a></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票抬头</td>
        <td align="right"><span class="hui">个人</span></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票内容</td>
        <td align="right"><a href="javascript:;" class="hui">请选择发票内容</a></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="3">商品清单</td>
       </tr>
       
       <tr>
       @foreach($data as $v)
        <td class="dingimg" width="15%"><img src="{{env('IMG')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <h3 style="color: red">¥{{$v->shop_price}}</h3>
         <time>下单时间：{{$v->add_time}}</time>
        </td>
        <td align="right"><span class="qingdan">X {{$v->car_number}}</span></td>
        @endforeach
       </tr>
       <tr>
        <th colspan="3"><strong class="orange">¥{{$price}}</strong></th>
       </tr>
      
       <tr>
        <td class="dingimg" width="75%" colspan="2">商品金额</td>
        <td align="right"><strong class="orange">¥{{$price}}</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">折扣优惠</td>
        <td align="right"><strong class="green">¥0.00</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">抵扣金额</td>
        <td align="right"><strong class="green">¥0.00</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">运费</td>
        <td align="right"><strong class="orange">¥20.80</strong></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     
  
    </div><!--content/-->
  
    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">¥{{$price}}</strong></td>
       <td width="40%"><a href="{{url('index/order/')}}?ids={{ $goods_id }}" class="jiesuan">提交订单</a></td>
      </tr>             
     </table>
    </div><!--gwcpiao/-->
       </form>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/index/js/bootstrap.min.js"></script>
    <script src="/index/js/style.js"></script>
    <!--jq加减-->
    <script src="/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
</html>
 <script src="/admin/js/jq.js/"></script>
         <script>
            // alert($);
            $('.pay').click(function(){
              // alert('添加购物车成功');
              $(this).addClass('orange').siblings('span').removeClass('orange');
              var order = $(this).attr('order');
              // alert(order);
              $.ajax({
                url:"{{url('index/paymode')}}",
                data:{order:order},
                type:'post',
                headers: {
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                 },
                success:function(res){
                  alert(res);
                }
              });
            })
             
        </script>