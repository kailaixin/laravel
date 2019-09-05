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
    <link href="/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/index/css/style.css" rel="stylesheet">
    <link href="/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond./index/js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <form action="#" method="get" class=""><input type="text" /> <input type="submit" value="搜索"></form>
      </div>
     </header>
     <ul class="pro-select">
      <li orderby="1" class="pro-selCur"><a href="javascript:;">新品</a></li>
      <li orderby="2"><a href="javascript:;">销量</a></li>
      <li orderby="3"><a href="javascript:;">上架</a></li>
     </ul><!--pro-select/-->

     <div class="prolist">
     @foreach($goods as $v)
      <dl>                        
       <dt><a href="{{ url('index/xiangqing/'.$v->gid)}}"><img src="{{env('IMG')}}{{$v->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{ url('index/xiangqing/'.$v->gid)}}">{{ $v->goods_name }}</a></h3>
        <div class="prolist-price"><strong>¥{{ $v->shop_price }}</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
    
     </div><!--prolist/-->
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="{{url('index/index')}}">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl class="ftnavCur">
       <a href="{{url('index/index')}}">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="{{url('index/car')}}">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="{{url('index/user')}}">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/index/js/bootstrap.min.js"></script>
    <script src="/index/js/style.js"></script>
    <!--焦点轮换-->
    <script src="/index/js/jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
  </body>
</html>
<!-- <script src="jq.js"></script> -->
<script>

       $(function(){
           $('ul li').click(function(){
                //
                   var _this = $(this);
                   $(this).addClass("pro-selCur").siblings().removeClass("pro-selCur");
                   var orderby = _this.attr('orderby');
                    // alert(orderby);
                    $.ajax({
                      url:"{{ url('index/list') }}",
                      data:{orderby:orderby},
                      headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                      type:'get',
                      success:function(res){
                        // alert(res);
                      }
                    });
           });

       });
    // alert(123);
    
</script>