<form action="{{url('/update/'.$res->id)}}" method="post">
	 @csrf
	<h2>学生信息编辑</h2>
	学生姓名:<input type="text" name="name" value="{{$res->name}}">
	<b style="color:red">{{$errors->first('name')}}</b>
	<br>
	性别:<input type="radio" name="sex" value="1" @if($res->sex==1) checked @endif>男
		<input type="radio" name="sex" value="2" @if($res->sex==2) checked @endif>女
		<b style="color:red">{{$errors->first('sex')}}</b>
		<br>
	班级:<input type="text" name="class" value="{{$res->class}}">
	<b style="color:red">{{$errors->first('class')}}</b>
	<br>
	成绩:<input type="text" name="num" value="{{$res->num}}">
	<b style="color:red">{{$errors->first('num')}}</b>
	<br>
	<input type="submit" value="编辑">
</form>