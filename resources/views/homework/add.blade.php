<form action="{{url('homework/do_add')}}" method="post">
	@csrf
	用户名:<input type="text" name="uname"><br>
	密码:<input type="password" name="upwd"><br>
	管理员身份:<input type="radio" name="authority" value="1">普通管理员
	        <input type="radio" name="authority" value="2">超级管理员<br>
	      <input type="submit" value="添加">
</form>