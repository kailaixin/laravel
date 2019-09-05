 @extends('layouts.index')

 @section('content')
  <div class="head-top">
      <img src="images/tim1g.jpg" />
      <dl>
       <dt><a href="{{url('index/user')}}"><img src="images/QQ图片20190814112316.jpg" /></a></dt>
       <dd>
        <h1 class="username">三级分销终身荣誉会员</h1>
        <ul>
         <li><a href="{{url('index/list')}}"><strong>{{$count}}</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="{{url('index/erweima')}}"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->

     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
      <li><a href="{{url('login')}}">登录</a></li>
      <li><a href="{{url('reg')}}" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
      <img src="images/image1.jpg" />
      <img src="images/image2.jpg" />
      <img src="images/image3.jpg" />
      <img src="images/image4.jpg" />
      <img src="images/image5.jpg" />
     </div><!--sliderA/-->
     <ul class="pronav">
     @foreach ($top_name as $v)
      <li><a href="{{ url('index/list/') }}?id={{$v->cid}}">{{ $v->cat_name }}</a></li>
      @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
     @foreach ($is_on_sale as $v)
      <div class="index-pro1-list">
       <dl>
        <dt><a href="{{url('index/xiangqing/'.$v->gid)}}"><img src="{{env('IMG')}}{{$v->goods_img}}" /></a></dt>
        <dd class="ip-text"><a href="{{url('index/xiangqing/'.$v->gid)}}">{{$v->goods_name}}</a><span>已售：{{$v->goods_number}}</span></dd>
        <dd class="ip-price"><strong>¥{{$v->shop_price}}</strong> <span>¥599</span></dd>
       </dl>
      </div>
      @endforeach
       
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
   
     <div class="prolist">
      @foreach ($is_hot as $v)
      <dl>
       <dt><a href="{{url('index/xiangqing/'.$v->gid)}}"><img src="{{env('IMG')}}{{$v->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$v->shop_price}}</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
     @endforeach
     </div><!--prolist/-->
    
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="{{url('index/index')}}">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="{{url('index/list')}}">
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
  @endsection