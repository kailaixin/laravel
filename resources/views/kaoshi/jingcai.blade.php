<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>竞猜</title>
</head>
<body>
	<form action="{{url('ball/insert')}}?ball_id={{$id}}" method="post" align="center">
	@csrf
				<h1>我要竞猜</h1>
				@foreach($data as $v)
				<h3>{{$v['jia']}}&nbsp;vs&nbsp;{{$v['yi']}}</h3>
				@endforeach

				<input type="radio" name="du_qiu" value="1">胜&nbsp;&nbsp;&nbsp;
				<input type="radio" name="du_qiu" value="2" checked>平&nbsp;&nbsp;&nbsp;
				<input type="radio" name="du_qiu" value="3">负&nbsp;&nbsp;&nbsp;<br>
				<br> <br> <br>

				<input type="submit" value="买定离手">
		</form>
</body>
</html>