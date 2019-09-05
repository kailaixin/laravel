<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>竞猜</title>
</head>
<body>
	<form action="{{url('ball/create')}}?ball_id={{$id}}" method="post" align="center">
	@csrf
				<h1>控制竞猜结果</h1>

				@foreach ($data as $v)
				<h3>{{$v->jia}}vs{{$v->yi}}</h3>
				@endforeach
				
				<input type="radio" name="kongzhi" value="1">胜&nbsp;&nbsp;&nbsp;
				<input type="radio" name="kongzhi" value="2" checked>平&nbsp;&nbsp;&nbsp;
				<input type="radio" name="kongzhi" value="3">负&nbsp;&nbsp;&nbsp;
				<br> <br> <br>

				<input type="submit" value="结果">
		</form>
</body>
</html>