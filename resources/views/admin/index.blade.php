<table border="1">
	<tr>
		<td>管理员id</td>
		<td>账号</td>
		<td>邮箱</td>
		<td>手机号</td>
		<td>头像</td>
		<td>操作</td>
	</tr>
	@foreach($data as $v)
	<tr>
		<td>{{$v->admin_id}}</td>
		<td>{{$v->account}}</td>
		<td>{{$v->email}}</td>
		<td>{{$v->tel}}</td>
		<td><img src="{{env('UPLOADS_URL')}}{{$v->head}}" width="60" height="60"></td>
		<td><a href="javascript:void(0)" onclick=del({{$v->admin_id}})>删除</a>
			<a href="{{url('/admin/edit/'.$v->admin_id)}}">编辑</a>
		</td>
	</tr>
	@endforeach
</table>
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script>
	function del(id){
		 // console.log(id);
		if(!id){
			return;
		}
		if(confirm('是否要删除此条记录')){
			//ajax删除
			$.get('/admin/destroy/'+id,function(res){
				if(res.code=='00000'){
					location.reload();
				}
			},
			'json',
			)
		}
	}
</script>