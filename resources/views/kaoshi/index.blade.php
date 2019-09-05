<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>展示列表</title>
</head>
<body>
	<form action="" align="center">
			<h1>竞猜列表</h1>
		@foreach($data as $v)
		<!-- @php var_dump(strtotime($v['time'])) @endphp -->
		<b>{{$v['jia']}}vs{{$v['yi']}}</b> &nbsp;&nbsp;&nbsp;
		@if(strtotime($v['time']) <= time()) <a href="{{url('/ball/jieguo')}}?id={{$v['ball_id']}}" style="color:red ">查看结果</a>
		@else <a href="{{url('/ball/jingcai')}}?id={{$v['ball_id']}}" style="color:green">竞猜</a> 
		<a href="{{url('/ball/kongzhi')}}?id={{$v['ball_id']}}" style="color:green">竞猜结果</a> 
		@endif<br>

		@endforeach
	</form>
</body>
</html>