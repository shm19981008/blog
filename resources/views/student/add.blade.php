<form action="{{url('creat')}}" method="post" enctype="multipart/form-data">
	 @csrf
	<h2>学生信息添加</h2>
	学生姓名:<input type="text" name="name" id="bname"><b id="name" style="color:red">*</b>
	<b style="color:red">{{$errors->first('name')}}</b>
	<br>
	性别:<input type="radio" name="sex" value="1">男
		<input type="radio" name="sex" value="2" checked>女
		<b style="color:red">{{$errors->first('sex')}}</b>
		<br>
	班级:<input type="text" name="class">
	<b style="color:red">{{$errors->first('class')}}</b>
	<br>
	成绩:<input type="text" name="num">
	<b style="color:red">{{$errors->first('num')}}</b>
	<br>
	头像:<input type="file" name="head"><br>
	<input type="submit" value="添加">
</form>
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script>
	$(function(){
		$('#bname').blur(function(){
			var val=$("#bname").val();
			var reg=/\w{2,12}/;
			if(val==''){
				$("#name").html('姓名不能为空');
			}else{
				$("#name").html('*');
			}
			if(!reg.test(val)){
				$("#name").html('姓名由数字字母下划线组成2-12位');
			};

		})
	})
</script>