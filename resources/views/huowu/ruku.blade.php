<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>入库</title>
</head>
<body>
	<form action="{{url('huowu/save')}}" method="post" algin="center" enctype="multipart/form-data">
	@csrf
		<table>
			<tr>
				<td>货物名称</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>货物图片</td>
				<td><input type="file" name="img"></td>
			</tr>
			<tr>
				<td>货物数量</td>
				<td><input type="text" name="number"></td>
			</tr>
			<tr>
				
				<td><input type="submit" value="入库"></td>
			</tr>
		</table>
	</form>
</body>
</html>