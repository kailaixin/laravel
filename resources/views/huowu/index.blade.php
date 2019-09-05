<!DOCTYPE html>
<html lang="en">
<head>
    <!-- error_reporting( E_ALL&~E_NOTICE ); -->
	<meta charset="UTF-8">
	<title>展示页面</title>
</head>
<body>
	<form action="" algin="center">
			<table border="1">
				<tr>
					<th>id</th>
					<th>货物名称</th>
					<th>货物图片</th>
					<th>货物库存</th>
					<th>入库时间</th>
					<th>出入库管理</th>
				</tr>
				@foreach($data as $v)
				<tr>
					<td>{{$v['huowu_id']}}</td>
					<td>{{$v['name']}}</td>
					<td><img src="{{env('IMG')}}{{$v['img']}}" width="40" height="50" alt=""></td>
					<td>{{$v['number']}}</td>
					<td>{{date('Y-m-d H:i:s',$v['add_time'])}}</td>
					<td>
					<a href="{{url('huowu/chu')}}?id={{$v['huowu_id']}}">出库</a>
					<a href="{{url('huowu/ru')}}?id={{$v['huowu_id']}}">入库</a>
					</td>
				</tr>
				@endforeach
			</table>
	</form>
</body>
</html>