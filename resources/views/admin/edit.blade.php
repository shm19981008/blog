<form action="{{url('/admin/update/'.$data->admin_id)}}" method="post" enctype="multipart/form-data">
	@csrf
	<h3>管理员编辑页面</h3>
	<table>
		<tr>
			<td>管理员账号</td>
			<td><input type="text" name="account" value="{{$data->account}}"></td>
		</tr>
		<tr>
			<td>邮箱</td>
			<td><input type="text" name="email" value="{{$data->email}}"></td>
		</tr>
		<tr>
			<td>手机号</td>
			<td><input type="text" name="tel" value="{{$data->tel}}"></td>
		</tr>
		<tr>
			<td>头像</td>
			<td><input type="file" name="head">
				<img src="{{env('UPLOADS_URL')}}{{$data->head}}" width="60" height="60">
			</td>
		</tr>
		<tr>
			<td><input type="submit" value="编辑"></td>
			<td></td>
		</tr>
	</table>
</form>