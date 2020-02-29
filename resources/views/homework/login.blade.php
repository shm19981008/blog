<form action="{{url('/homework/do_login')}}" method="post">
	@csrf
	用户名:<input type="text" name="uname"><br>
	密码：<input type="password" name="upwd"><br>
	<input type="submit" 登录="">
</form>