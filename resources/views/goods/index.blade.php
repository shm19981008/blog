<form>
	<input type="text" name="goods_name" placeholder="请输入商品名称" value="{{$goods_name}}">
	<select name="brand_id">
		<option value="">请选择品牌</option>
		@foreach($brandinfo as $v)
		<option value="{{$v->id}}" >{{$v->bname}}</option>
		@endforeach
	</select>
	<input type="submit" value="搜索">
</form>
<table border="1">
	<tr>
		<td>商品id</td>
		<td>商品名称</td>
		<td>商品价格</td>
		<td>商品货号</td>
		<td>商品照片</td>
		<td>商品库存</td>
		<td>是否精品</td>
		<td>是否热卖</td>
		<td>商品介绍</td>
		<td>商品相册</td>
		<td>商品分类</td>
		<td>商品品牌</td>
		<td>操作</td>
	</tr>
	@foreach($data as $v)
	<tr>
		<td>{{$v->goods_id}}</td>
		<td>{{$v->goods_name}}</td>
		<td>{{$v->goods_price}}</td>
		<td>{{$v->goods_sn}}</td>
		<td><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="60" height="60"></td>
		<td>{{$v->goods_num}}</td>
		<td>{{$v->is_best==1?'√':'×'}}</td>
		<td>{{$v->is_hot==1?'√':'×'}}</td>
		<td>{{$v->goods_desc}}</td>
		<td>
			@if($v->goods_imgs)
		    @php $photos=explode('|',$v->goods_imgs);@endphp
		    @foreach($photos as $vv)
		    <img src="{{env('UPLOADS_URL')}}{{$vv}}" width="60" height="60">
		    @endforeach
		    @endif
		</td>
		<td>{{$v->cate_name}}</td>
		<td>{{$v->bname}}</td>
		
		<td><a href="{{url('/goods/del/'.$v->goods_id)}}">删除</a>
			<a href="{{url('/goods/edit/'.$v->goods_id)}}">修改</a>
		</td>
	</tr>
	@endforeach
</table>
{{$data->appends(['goods_name'=>$goods_name])->links()}}