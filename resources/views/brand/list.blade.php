<form>
	<input type="text" name="bname" value="{{$bname}}" placeholder="请输入搜索名称">
	<input type="submit" value="搜索">
</form>
<table border=1>
	<tr>
		<td>id</td>
		<td>品牌名称</td>
		<td>品牌logo</td>
		<td>品牌网址</td>
		<td>描述</td>
		<td>操作</td>
	</tr>
	@foreach($res as $v)
	<tr>
		<td>{{$v->id}}</td>
		<td>{{$v->bname}}</td>
		<td><img src="{{env('UPLOADS_URL')}}{{$v->logo}}" width="60" height="60"></td>
		<td>{{$v->url}}</td>
		<td>{{$v->desc}}</td>
		<td><a href="{{url('/delete',$v->id)}}">删除</a>
		<a href="{{url('/edit',$v->id)}}">修改</a>
		</td>
	</tr>
	@endforeach

</table>
{{$res->appends(['bname'=>$bname])->links()}}