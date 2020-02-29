<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>学生信息列表展示</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<form>
	<input type="text" name="name" value="{{$name}}" placeholder="输入学生姓名">
	<input type="text" name="class" value="{{$class}}" placeholder="输入学生班级">
	<input type="submit" value="搜索">
</form>
<table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>id</th>
			<th>姓名</th>
			<th>性别</th>
			<th>班级</th>
			<th>成绩</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($res as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->id}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->sex==1?'男':'女'}}</td>
			<td>{{$v->class}}</td>
			<td>{{$v->num}}</td>
			<td><img src="{{env('UPLOADS_URL')}}{{$v->head}}" width="60" height="60"></td>
			<td><a href="{{url('/edit/'.$v->id)}}" class="btn btn-info">编辑</a>
				<a href="{{url('/delete/'.$v->id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach

	</tbody>
</table>
	{{$res->appends(['name'=>$name])->links()}}
</body>
</html>