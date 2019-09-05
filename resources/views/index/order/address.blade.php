
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
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('index/save')}}" method="post" class="reg-login">
     @csrf
      <div class="lrBox">
       <div class="lrList"><input type="text"  name="shr" placeholder="收货人" /></div>
       <div class="lrList"><input type="text" name="xiangxi" placeholder="详细地址" /></div>
       <div class="lrList">
        <select name="zhong" >
         <option value="0">请选择...</option>
        @foreach ($top as $v)
         <option value="{{$v->region_id}}">{{$v->region_name}}</option>
         @endforeach
         </select>
       </div>
       <div class="lrList">
        <select  name="sheng" >
           <option value="0" >请选择...</option>
        </select>
       </div>
         <div class="lrList">
        <select  name="shi" >
           <option value="0" >请选择...</option>
        </select>
       </div>
       <div  class="lrList">
        <select name="xian" >
         <option value="0" >请选择...</option>
        </select>
       </div>
       <div class="lrList"><input type="text" name="tel" placeholder="手机" /></div>
       <div class="lrList2"><input type="text" placeholder="设为默认地址" /> <button>设为默认</button></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="保存" />
      </div>
     </form><!--reg-login/-->
     
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
      <dl class="ftnavCur">
       <a href="{{url('index/user')}}">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
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

          // 四级联动
      $('select').change(function(){
        var parent_id = $(this).val();
        var str = '<option value="0">请选择...</option>';
        var obj = $(this);
        // alert(parent_id);return;
        $.ajax({
          url:"{{url('index/address_do')}}",
          data:{parent_id:parent_id},
          type:'post',
          dataType:'json',
          headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
          success:function(res){
            $.each(res,function(i,v){
              // alert(v);
              str += '<option value='+v.region_id+'>'+v.region_name+'</option>';
            });
            obj.parent('div').next('div').children('select').html(str).show();
           
          }
        });
        // $.post("{:url('Address/getSonAddress')}",{parent_id:parent_id},function(res){
        //           $.each(res,function(i,v){
        //             // 
        //             str +='<option value='+v.region_id+'>'+v.region_name+'</option>';
        //           });
        //            obj.next().html(str).show();
        // },'json');
      });
      // alert($);
</script>