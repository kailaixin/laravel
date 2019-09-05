<!DOCTYPE html>
<html lang="zh-cn">
  <head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      <table>
   
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" class="all" /> 全选</a><a href=""><input type="button"  id="delete" value="删除"></a></td>
       </tr>
          @foreach ($car as $v)
       <tr >
        <td width="4%"><input type="checkbox" value="{{$v->car_id}}" name="checkboxes[]" class="one" /></td>
        <td class="dingimg" width="15%"><img src="{{env('IMG')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date('Y-m-d H:i:s',$v->add_time)}}</time>
        </td>
        <td align="right"><input type="text" class="spinnerExample" /></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->shop_price}}</strong></th>
       </tr>
       @endforeach
      </table>
      <!-- <script src="jq.js"></script> -->
     
     </div><!--dingdanlist/-->
      </table>
     </div><!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange price">¥00.00</strong></td>
       <td width="40%"><a href="Javascript:void(0)" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>
    <!--jq加减-->
    <script src="js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
</html>
 <script>
    $('.jiesuan').click(function(){
         var goods_id = new Array();
         // alert(goods_id);
         var  obj = $('[name="checkboxes[]"]:checked');
          $.each(obj,function(){
            var ids = $(this).val();
            // alert(ids);
            goods_id.push(ids);
          }) ;
           if(!goods_id.length){
          alert('请勾选要购买的商品');return;
        } 
          // var url = "{:url('index/order')}?ids="+goods_id;
          location.href = "{{url('index/order')}}?ids="+goods_id;
             
            
    });
      //全选 全不选
    $('.all').click(function(){
       $('.one:checkbox').prop('checked',$(this).prop('checked'));
         getMoney();
    });
    // 单选
        $(document).on('click','.one',function(){
          // alert(1234);return;
            $(this).prop('checked');
            getMoney();
        });
        //计算价格
        function getMoney()
        {
          var vals = new Array();
          // alert(vals);return;
            $('[name="checkboxes[]"]:checked').each(function(){
              vals.push($(this).val());
            });
            // alert(vals);return;
            $.ajax({
                url:"{{url('index/getMoney')}}",
                data:{vals:vals},
                dataType:'json',
                type:'post',
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                success:function(res){
                     // alert(res);
                     $('.price').text(res);
                }
         });
        }
    // 批删
    $('#delete').click(function(){
      event.preventDefault();
      // 获取多个id
      var _this = $(this);
      var  obj = $('[name="checkboxes[]"]:checked');
      // alert(obj); 
      //定义一个新的数组 用于存储id
      var delid = new Array();
      $.each(obj,function(){
        //获取obj中的id
        var id = $(this).val();
        delid.push(id);
      // alert(delid);
      });
      $.ajax({
        url:"{{url('index/delete')}}",
        data:{delid:delid},
        dataType:'json',
        type:'post',
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        success:function(res){
            if(res.code=="00000"){
              alert('删除成功');location.href="/index/car";
            }else{
              alert('删除失败');location.href="/index/car";
            }
        }
      });
    });
      </script>