<form action="{{route('do')}}" method="get">
	@csrf
	<input type="text" name="name">
	<input type="number" name="age">
	<input type="submit" value="提交">
</form>