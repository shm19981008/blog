<form action="{{url('/admin/store')}}" method="post" enctype="multipart/form-data">
	@csrf
	<h3>管理员添加页面</h3>
	<table>
		<tr>
			<td>管理员账号</td>
			<td><input type="text" name="account">
				<b style="color:red">{{$errors->first('account')}}</b>
			</td>
		</tr>
		<tr>
			<td>管理员密码</td>
			<td><input type="password" name="pwd">
				<b style="color:red">{{$errors->first('pwd')}}</b>
			</td>
		</tr>
		<tr>
			<td>确认密码</td>
			<td><input type="password" name="pwd2"></td>
		</tr>
		<tr>
			<td>邮箱</td>
			<td><input type="text" name="email">
				<b style="color:red">{{$errors->first('email')}}</b>
			</td>
		</tr>
		<tr>
			<td>手机号</td>
			<td><input type="text" name="tel">
				<b style="color:red">{{$errors->first('tel')}}</b>
			</td>
		</tr>
		<tr>
			<td>头像</td>
			<td><input type="file" name="head"></td>
		</tr>
		<tr>
			<td><input type="submit" value="提交"></td>
			<td></td>
		</tr>
	</table>
</form>