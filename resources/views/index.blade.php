<!DOCTYPE html>
<html lang="en">
<head>

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="UTF-8">
	<title>展示</title>
</head>
<body>
	<table border="1" width="500" align="center">
		<tr>
			<th>id</th>
			<th>新闻</th>
			<th>添加时间</th>
			<th>点赞</th>
		</tr>
	@foreach ($data as $v)
		<tr align="center" >
			<td>{{$v['w_id']}}</td>
			<td><a href="{{url('kao/list')}}?id={{$v['w_id']}}">{{$v['biaoti']}}</a></td>
			<td>{{date('Y-m-d H:i:s',$v['add_time'])}}</td>
			<td >
			<span class="num{{$v['w_id']}}">{{$v['number']}}</span>
			 
			<span class="up" id="{{$v['w_id']}}" style="color:red ">{{$v['flag']}}</span>
			</td>
		</tr>
		@endforeach
	</table>
</body>
</html>
<script src="/admin/js/jq.js"></script>
<script>
		$('.up').click(function(){
			// alert(123);
			var obj = $(this);
			var id = $(this).attr('id');
			var number = $('.num'+id).html();
			// alert(number);
			var dianzan = $(this).text();
				
			if(dianzan == '点赞'){
				$(this).text('取消点赞');
				flay=0;
			}else{
				$(this).text('点赞');
				flay=1;
			}

			// alert(flag);
			$.ajax({
				url:"{{url('kao/give')}}",
				data:{id:id,flay:flay,number:number},
				dataType:'json',
				type:'post',
				async: false,

				headers: {
				 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				 },

				success:function(res){
					// alert(res);
					
					obj.prev('span').html(res.number);
				}
			})

			

		})
		
</script>