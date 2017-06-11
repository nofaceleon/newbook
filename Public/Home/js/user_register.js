function checkuser(e){
		//获取用户填写的用户名
		var username=$(e).val();//已经成功获取到用户提交的用户名
		var url=$('#user_name').data('url');
		//alert(username);
	 $.ajax({
		 	
			url:url,
			data:{username:username},
			dataType:'json',
			type:'get',
			success:function(res){
				if(res.flag){
					//用户没有被注册
					$('#usernameinfo').css('color','green');
					$('#usernameinfo').html(res.mes);
				}else{ 
					//用户已经被注册
					$('#usernameinfo').css('color','red');
					$('#usernameinfo').html(res.mes);
				}			
			}
		});
	}
	
	function checkcode(e)
	{
		//先获取用户输入的验证码
		var code=$(e).val();
		var url=$('#code').data('url');
		//将获取到的数据通过ajax传给php文件
		$.ajax({
			url:url,
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