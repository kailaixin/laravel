<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>比赛结果</title>
</head>
<body>
		<form action="" align="center">
		@csrf
				<h1>比赛结果</h1>
				@foreach($data as $v)
				<h3>{{$v['jia']}}&nbsp;vs&nbsp;{{$v['yi']}}</h3>
				@endforeach

				@foreach($jieguo as $v)
				
				<input type="radio" name="ya" @if($v['kongzhi']==1) checked @endif>胜&nbsp;&nbsp;&nbsp;
				
			
				<input type="radio" name="ya" @if($v['kongzhi']==2) checked @endif>平&nbsp;&nbsp;&nbsp;
				
				
				<input type="radio" name="ya" @if($v['kongzhi']==3) checked @endif>负&nbsp;&nbsp;&nbsp;
				
				@endforeach
				<h3>对阵结果:
				{{$data[0]['jia']}} 
				<b>
				@if($jieguo[0]['kongzhi']==1)胜@endif
				@if($jieguo[0]['kongzhi']==2)平@endif
				@if($jieguo[0]['kongzhi']==3)负@endif
				</b> 
				{{$data[0]['yi']}}
				</h3>
				<h3>您的竞猜:
				{{$data[0]['jia']}} 
				<b>
				@if($jieguo[0]['du_qiu']==1)胜@endif
				@if($jieguo[0]['du_qiu']==2)平@endif
				@if($jieguo[0]['du_qiu']==3)负@endif
				{{$data[0]['yi']}}
				</b>
				</h3>
				<h3>结果:
				@if($jieguo[0]['du_qiu']==$jieguo[0]['kongzhi'])恭喜您;中奖了@endif
				@if($jieguo[0]['du_qiu']!=$jieguo[0]['kongzhi'])很遗憾;您没猜中@endif
				</h3>
		</form>
</body>
</html>