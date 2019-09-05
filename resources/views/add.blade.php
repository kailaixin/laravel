<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新闻添加</title>
</head>
<body>
	<form action="{{url('kao/save')}}" method="post" align="center">
	<h1>添加页</h1>
	@csrf
		标题: <input type="text" name="biaoti"><br>
		作者: <input type="text" name="zuozhe"><br>
		内容: <textarea name="neirong" id="" cols="30" rows="10"></textarea><br>
		      <input type="submit" value="添加">
	</form>
</body>
</html>