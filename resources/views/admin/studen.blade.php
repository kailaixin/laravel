<form action="{{route ('do')}}" method="post" enctype="multipart/form-data">
    @csrf
    <p>姓名<input type="text" name="name"></p>
    <p><input type="file" name="photo"></p>
    <p>性别<input type="radio" name="sex" value="0">男<input type="radio" name="ses" value="1">女</p>
    <p>年龄<input type="number" name="age"></p>
    
    <p><button>提交</button></p>
</form>
<script src="/admin/js/jq.js"></script>
<script>
	// 
	$("input[name='name']").blur(function(){
			// alert(123);
			var name = $(this).val();
			// alert(name);
			$(this).next('b').remove();
			var msg = /^[\u4e00-\u9fa5A-Za-z._]{2,16}$/;
			if(name==""){
				$(this).after('<b style="color:red">姓名不能为空</b>');
				return;
			}
			if(!msg.test(name)){
				$(this).after('<b style="color:red">姓名必须以汉字 字母 .组成的2-16位</b>');
				return;
			}
			$.ajax({
				url:"{url('checkonly')}",
				data:

			});
			
	});
	$("input[name='age']").blur(function(){
			// alert(123);
			var age = $(this).val();
			// alert(name);
			$(this).next('b').remove();
			var msg = /^[0-9]{1,3}$/;
			if(age==""){
				$(this).after('<b style="color:red">年龄不能为空</b>');
				return;
			}
			if(!msg.test(age)){
				$(this).after('<b style="color:red">请输入正确的年龄</b>');
				return;
			}
	});
</script>