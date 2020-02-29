<table border=1>
	<tr>
		<td>id</td>
		<td>用户名</td>
		<td>管理员身份</td>
		<td>操作</td>
	</tr>
	@foreach($user as $v)
	<tr>
		<td>{{$v->id}}</td>
		<td>{{$v->uname}}</td>
		<td>{{$v->authority==1?'普通管理员':'超级管理员'}}</td>
		<td><a href="{{url('homework/destroy/'.$v->id)}}">删除</a>
<a href="{{url('homework/add')}}">添加</a>
		</td>
	</tr>
	@endforeach
</table>
			