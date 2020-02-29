<form action="{{url('/update/'.$res->id)}}" method="post" enctype="multipart/form-data">
	@csrf
	<h3>品牌修改页面</h3>
	品牌名称:<input type="text" name="bname" value="{{$res->bname}}"><br>
	品牌logo:<input type="file" name="logo">
	<img src="{{env('UPLOADS_URL')}}{{$res->logo}}" width="60" height="60">
	<br>
	品牌网址:<input type="text" name="url" value="{{$res->url}}"><br>
	品牌描述:<textarea name="desc">{{$res->desc}}</textarea><br>
	<input type="submit" value="修改">
</form>