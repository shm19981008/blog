<center><b style="color:red">{{session('msg')}}</b></center>
<form action="{{url('logindo')}}" method="post">
	@csrf
	用户名:<input type="text" name="uname"><br>
	密码:<input type="password" name="upwd"><br>
	<input type="submit" value="登录">
</form>