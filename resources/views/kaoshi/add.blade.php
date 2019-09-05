<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加页面</title>
</head>
<body>
	<form action="{{url('ball/save')}}" method="post" algin="center">
	@csrf
			<h1 algin="center">添加竞猜球队</h1>
		<table algin="center">
			<tr>
				<td><input type="text" name="jia">&nbsp;&nbsp;<b>vs</b>&nbsp;&nbsp;<input type="text" name="yi"></td>
			</tr>
			<tr>
				<td><b>结束竞猜时间</b>:<input type="text" name="time"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="添加"></td>
			</tr>
			
		</table>
	</form>
</body>
</html>