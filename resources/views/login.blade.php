<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
</head>
<body>
	
</body><form action="{{url('kao/logindo')}}" method="post">
		@csrf
		用户名: <input type="text" name="name"><br>
		密码 :  <input type="password" name="pwd"><br>
		<input type="submit" value="登录">
</form>
</html>