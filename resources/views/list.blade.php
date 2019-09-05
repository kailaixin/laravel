<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新闻内容</title>
</head>
<body>
	<table align="center">
		<tr>
			<th>新闻标题</th>
			<th>新闻内容</th>
		</tr>
		@foreach($data as $v)
		<tr>
			<td>{{$v->biaoti}}</td>
			<td>{{$v->neirong}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>