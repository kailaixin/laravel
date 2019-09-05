<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>友情链接添加-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">友情链接管理</a>&nbsp;-</span>&nbsp;友情链接添加
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>友情链接添加</span>
				</div>
				<form action="{{route ('friend_do')}}" method="post" enctype="multipart/form-data">
				<div class="baBody">
					@csrf
					<div class="bbD">
						网站名称：<input type="text" name="w_name" class="input3" />@php echo($errors->first('w_name')) ;@endphp
					</div>
					<div class="bbD">
						网站网址：<input type="text" name="w_site" class="input3" />@php echo($errors->first('w_site')) ;@endphp
					</div>
					<div class="bbD">
						链接类型：<input type="radio" checked="checked"
						name="w_catena" value="1" />&nbsp;LOGO链接</label><label><input type="radio"
						name="w_catena" value="2" />&nbsp;文字链接</label>
					</div>
					<div class="bbD">
						图片LOGO:<input type="file" name="w_logo" />
					</div>
					<div class="bbD">
						网站联系人：<input type="text" name="w_tel" class="input3" />@php echo($errors->first('w_tel')) ;@endphp
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;网站介绍：
						<div class="btext2">
							<textarea class="text2" name="w_desc"></textarea>@php echo $errors->first('w_desc'); @endphp
						</div>
					</div>
					<div class="bbD">
						是否显示：<label><input type="radio" checked="checked"
							name="w_show" value="1"/>&nbsp;是</label><label><input type="radio"
							name="w_show" value="2"/>&nbsp;否</label>
					</div>
					<div class="bbD">
						<p class="bbDP">
						<input type="submit" class="btn_ok btn_yes" value="提交"/>
						</p>
					</div>
				</div>
			</div>
			</form>
			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>