//window.flag1=false;
//window.flag2=false;
//window.flag3=false;

function checkcode(e){
	//获取用户输入的验证码
	var code=$(e).val();
	var url=$('#code').data('url');
	$.ajax({
		url:url,
		data:{code:code},
		dataType:'json',
		type:'post',
		success:function(res){
			if(res.flag){
				//验证码正确
				$('#code').css('color','green');
				$('#code').html(res.mes);
				window.flag4=true;//定义一个全局变量flag4
			}else{
				//验证码错误
				$('#code').css('color','red');
				$('#code').html(res.mes);
				window.flag4=false;
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
		if(window.flag4){
			flag3=true;
			$('#code').html('');
		}else{
			flag3=false;				
		}
	}else{
		$('#code').html('请输入验证码！').css('color','red');
	}

	if(flag1&&flag2&&flag3){
		return true;
	}else{
		return false;
	}
}

//获取各个输入框的值，然后判断是否为空
$('#user_name').blur(function(){
	//还是要重新获取具体的值
	var username=$("#user_name").val();
	if(username!=''){
		$('#usernameinfo').html('');
	}else{
		$('#usernameinfo').css('color','red').html('用户名不能为空!');
	}
});

$('#password').blur(function(){
	//还是要重新获取具体的值
	var password=$("#password").val();
	if(password!=''){
		$('#passwordinfo').html('');
	}else{
		$('#passwordinfo').css('color','red').html('密码不能为空!');
	}
});



