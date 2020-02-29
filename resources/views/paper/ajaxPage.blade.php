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