function checkcode(e)
{
	//先获取用户输入的验证码
	var code=$(e).val();
	//将获取到的数据通过ajax传给php文件
	$.ajax({
		url:'?m=home&c=userregister&a=checkcode',
		data:{code:code},
		dataType:'json',
		type:'post',
		success:function (res){
			if(res.flag){
				//验证成功
				$('#code').css('color','green');
				$('#code').html(res.mes);					
			}else{
				//验证失败				
				$('#code').css('color','red');
				$('#code').html(res.mes);
				
			}
		}
		
	});
}

//当用户名，密码，验证码为空的时候不能提交表单

function checkempty(){
	var username=$('#user_name').val();
	var password=$('#password').val();
	var captchar=$('#captchar').val();
	var flag1=false;
	var flag2=false;
	var flag3=false;
	if(!username==''){
		flag1=true;
		$('#usernameinfo').html('');
		
	}else{
		$('#usernameinfo').html('用户名不能为空!').css('color','red');
	}
	if(!password==''){
		flag2=true;
		$('#passwordinfo').html('');	
	}else{
		$('#passwordinfo').html('密码不能为空!').css('color','red');
	}
	if(!captchar==''){
		flag3=true;
		$('#code').html('');
	}else{
		$('#code').html('请输入验证码！').css('color','red');
	}

	if(flag1&&flag2&&flag3){
		return true;
	}else{
		return false;
	}
}