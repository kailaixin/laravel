<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>出库</title>
</head>
<body>
	<form action="{{url('huowu/chu_do')}}?id={{$id}}" method="post" algin="center" enctype="multipart/form-data">
	@csrf
		<table>
			<tr>
				<td>货物名称</td>
				<td><input type="text" name="name" value="{{$data[0]['name']}}"></td>
			</tr>
			
			<tr>
				<td>货物数量</td>
				<td><input type="text" name="number"></td>
			</tr>
			<tr>
				
				<td><input type="submit" value="出库"></td>
			</tr>
		</table>
	</form>
</body>
</html>