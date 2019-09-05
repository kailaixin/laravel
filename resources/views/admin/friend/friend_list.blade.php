<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>友情管理-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap.min.css">
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/admin/js/page.js" ></script>
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">友情链接管理</a>&nbsp;-</span>&nbsp;友情链接管理

			</div>

		</div>
		<a class="addA addA1" href="{{route ('friend')}}">添加友情链接+</a>

		<div class="page">
			<!-- topic页面样式 -->
			<div class="topic">
				<div class="conform">
					<form>
						<div class="cfD">
							商品名称：<input class="timeInput" type="text" name="w_name" value="{{$w_name}}"/>
							 <input class="button" type="submit" value="搜索" />

						</div>
					</form>

						
				</div>
				<!-- topic表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="125px" class="tdColor">网站名称</td>
							<td width="125px" class="tdColor">网站网址</td>
							<td width="125px" class="tdColor">链接类型</td>
							<td width="125px" class="tdColor">图片LOGO</td>
							<td width="125px" class="tdColor">网站联系人</td>
							<td width="100px"  class="tdColor">网站介绍</td>
							<td width="125px" class="tdColor">是否显示</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
						@foreach ($data as $v)
						<tr>
							<td class="w_id">{{$v->w_id}}</td>
							<td>{{$v->w_name}}</td>
							<td>{{$v->w_site}}</td>
							<td>@if($v->w_catena==1)LOGO链接@else 文字链接@endif</td>
							<td><img src="{{env('IMG')}}{{$v->w_logo}}" height="60" alt=""></td>
							<td>{{$v->w_tel}}</td>
							<td>{{$v->w_desc}}</td>
							<td>@if($v->w_show==1)是@else 否@endif</td>
							<td>
								<a href="{{url ('friend_exit/'.$v->w_id)}}">
									<img class="operation" src="/admin/img/update.png"></a> 
									<img class="operation delban" src="/admin/img/delete.png"></td>
						</tr>
						@endforeach
					</table>
					<div class="paging">{{ $data->appends($query)->links()}}</div>
				</div>
				<!-- topic 表格 显示 end-->
			</div>
			<!-- topic页面样式end -->
		</div>

	</div>

	<!-- 删除弹出框  end-->
<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="/admin/img/shanchu.png" /></a>
			</div>
			<p class="delP1">你确定要删除此条记录吗？</p>
			<p class="delP2">
			<input type="hidden" name="w_id" value="" id="w_id">
				<a href="javascript:deletes()" class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>
<script type="text/javascript">
// 广告弹出框
$(".delban").click(function(){
  $(".banDel").show();
  var w_id=$(this).parent().siblings('.w_id').text();
	$('#w_id').val(w_id);	
	
});
function deletes()
{
	var w_id=$('#w_id').val();
	$.ajax({
            url:"{{url ('friend_delete')}}",
            dataType:'json',
            data:{w_id:w_id},
            success:function(res){
				//   alert(123);
				location.href="{{route ('friend_list')}}";
            }
          })
}
$(".close").click(function(){
  $(".banDel").hide();
});
$(".no").click(function(){
  $(".banDel").hide();
});
// 广告弹出框 end
</script>
</html>