<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录系统</title>
</head>
<body>
	<form action="{{url('huowu/login_do')}}" method="post" algin="center">
		@csrf 
		用户名: <input type="text" name="name"><br>
		密码 :  <input type="password" name="pwd"><br>
		<input type="submit" value="登录">
	</form>
</body>
</html>