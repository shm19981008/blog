<form>
	
	<input type="text" name="title" placeholder="请输入要查询的标题" value="{{$title}}">
	<input type="submit" value="搜索">
</form>
<table border=1>
	<tr>
		<td>编号</td>
		<td>文章标题</td>
		<td>文章分类</td>
		<td>文章重要性</td>
		<td>是否显示</td>
		<td>上传文件</td>
		<td>添加日期</td>
		<td>操作</td>
	</tr>
	<tbody>
	@foreach($res as $k=>$v)
	<tr id="{{$v->id}}">
		<td>{{$v->id}}</td>
		<td>{{$v->title}}</td>
		<td>{{$v->type}}</td>
		<td>{{$v->important}}</td>
		<td>{{$v->is_show==1?'√':'×'}}</td>
		<td><img src="{{env('UPLOADS_URL')}}{{$v->file}}" width="60" height="60"></td>
		<td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
		<td><a href="javascript:void(0)" onclick=del({{$v->id}})>删除</a>
			<a href="{{url('/paper/edit/'.$v->id)}}">修改</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
{{$res->appends(['title'=>$title,'type'=>$type])->links()}}
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script>
	function del(id){
		// console.log(id);
		if(!id){
			return;
		}
		if(confirm('是否要删除此条记录')){
			//ajax删除
			$.get('/paper/destroy/'+id,function(res){
				if(res.code=='00000'){
					location.reload();
				}
			},
			'json',
			)
		}
	}
</script>
<script>
	//ajax分页
	$(document).on('click','.pagination a',function(){
		// alert(1);
		var url=$(this).attr('href');
		if(!url){
			return;
		}
		$.get(
			url,
			function(res){
				$('tbody').html(res);
			}

			);
			return false;
	})
</script>