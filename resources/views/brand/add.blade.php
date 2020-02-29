@if ($errors->any()) 
<div class="alert alert-danger"> 
<ul>@foreach ($errors->all() as $error) 
<li>{{ $error }}</li>
 @endforeach
 </ul>
</div>
 @endif
<form action="{{url('do_add')}}" method="post" enctype="multipart/form-data">
	@csrf
	<h3>品牌添加页面</h3>
	品牌名称:<input type="text" name="bname">
	<b style="color:red">{{$errors->first('bname')}}</b>
	<br>
	品牌logo:<input type="file" name="logo">

	<br>
	品牌网址:<input type="text" name="url">
	<b style="color:red">{{$errors->first('url')}}</b>
	<br>
	品牌描述:<textarea name="desc"></textarea><br>
	<input type="submit" value="添加">
</form>