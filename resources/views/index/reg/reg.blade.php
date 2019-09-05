@if ($errors->any())
 <div class="alert alert-danger">
 <ul>
<!--  @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach -->
 </ul>
 </div>
@endif
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
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('reg_do')}}" method="post" class="reg-login">
     @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="reg_name" placeholder="输入手机号码或者邮箱号" /></div>@php echo $errors->first('reg_name');@endphp
       <div class="lrList2"><input type="text" name="reg_code" placeholder="输入短信验证码" /> <button id="huoqu">获取验证码</button></div>@php echo $errors->first('reg_code'); @endphp
       <div class="lrList"><input type="password" name="reg_pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>@php echo $errors->first('reg_pwd'); @endphp
       <div class="lrList"><input type="password" name="reg_pwd2" placeholder="再次输入密码" /></div>@php echo $errors->first('reg_pwd2'); @endphp
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="index.html">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="prolist.html">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car.html">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="user.html">
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
  </body>
</html>
<script src="/jq.js"></script>
<script>
  $(function(){
        $('#huoqu').click(function(){
            event.preventDefault();
            //获取验证码
           var email = $('input[name="reg_name"]').val();
           // alert(email);
           $('input[name="reg_name"]').next('b').remove();
           // 验证邮箱是否为空?格式是否正确?
          var reg=/^\w+@\w+\.com$/;
         if(email==""){
          $('input[name="reg_name"]').after('<b style="color:red">邮箱必填</b>');
          return;
         }
         if(!reg.test(email)){
          $('input[name="reg_name"]').after('<b style="color:red">邮箱格式不正确</b>');
          return;
         }
        //3.倒计时 读秒
           var second=600;
           $('#huoqu').text(second+'s');
           //定时器
          _time=setInterval(lessSecond,1000);//每1000毫秒执行一次代码
         //把验证好的邮箱传给控制器
       $.ajax({
          url:"{{url('/index/send')}}",
          data:{email:email},
          type:'post',
          dataType:'json',
          headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          },
          success:function(res){
             // alert(res.code);
            if(res.code=='00000'){
              alert(res.msg);
            }
          }

       });
          return false; 
        });
        function lessSecond(){
              //获取秒数
            var num=$('#huoqu').text();
            num=parseInt(num);
            // console.log(num);
            if(num<=0){
              $('#huoqu').text('获取');
              //清除定时器
              clearInterval(_time);
              //按钮生效
              $('#huoqu').css('pointer-events','auto');
            }else{
              //把秒数减yi
              num=num-1;
              $('#huoqu').text(num+'s');
              // 按钮失效
              $('#huoqu').css('pointer-events','none');


            }
            }
  });
    
</script>
