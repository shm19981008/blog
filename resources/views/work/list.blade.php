<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bootstrap 实例 - 上下文类</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>id</th>
			<th>姓名</th>
			<th>年龄</th>
			<th>身份证号</th>
			<th>是否湖北人</th>
			<th>头像</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->id}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->age}}</td>
			<td>{{$v->card}}</td>
			<td>{{$v->is_hubei==1?'√':'×'}}</td>
			<td></td>
			<td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
			<td><a href="{{url('/people/edit/'.$v->id)}}" class="btn btn-info">编辑</a>
				<a href="{{url('/people/delete/'.$v->id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>