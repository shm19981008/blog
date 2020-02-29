<form action="{{url('/goods/update/'.$data->goods_id)}}" method="post" enctype="multipart/form-data">
	@csrf
	<h3>商品修改页面</h3>
	<table>
		<tr>
			<td>商品名称</td>
			<td><input type="text" name="goods_name" value="{{$data->goods_name}}">
				<b style="color:red">{{$errors->first('goods_name')}}</b>
			</td>
		</tr>
		<tr>
			<td>商品价格</td>
			<td><input type="text" name="goods_price" value="{{$data->goods_price}}">
				<b style="color:red">{{$errors->first('goods_price')}}</b>
			</td>
		</tr>
		<tr>
			<td>商品图片</td>
			<td><input type="file" name="goods_img">
				<img src="{{env('UPLOADS_URL')}}{{$data->goods_img}}" width="60" height="60">
			</td>
		</tr>
		<tr>
			<td>商品库存</td>
			<td><input type="text" name="goods_num" value="{{$data->goods_num}}"></td>
		</tr>
		<tr>
			<td>是否精品</td>
			<td><input type="radio" name="is_best" value="1" @if($data->is_best==1) checked @endif>是
				<input type="radio" name="is_best" value="2" @if($data->is_best==2) checked @endif>否
			</td>
		</tr>
		<tr>
			<td>是否热卖</td>
			<td><input type="radio" name="is_hot" value="1"  @if($data->is_hot==1) checked @endif>是
				<input type="radio" name="is_hot" value="2"  @if($data->is_hot==2) checked @endif>否
			</td>
		</tr>
		<tr>
			<td>商品介绍</td>
			<td><textarea name="goods_desc">{{$data->goods_desc}}</textarea></td>
		</tr>
		<tr>
			<td>商品相册</td>
			<td><input type="file" name="goods_imgs[]" multiple="multiple">
			@if($data->goods_imgs)
		    @php $photos=explode('|',$data->goods_imgs);@endphp
		    @foreach($photos as $vv)
		    <img src="{{env('UPLOADS_URL')}}{{$vv}}" width="60" height="60">
		    @endforeach
		    @endif
			</td>
		</tr>
		<tr>
			<td>商品分类</td>
			<td><select name="cate_id">
				@foreach($info as $v)
				<option value="{{$v->cate_id}}" @if($v->cate_id==$data->cate_id) selected @endif>{{str_repeat('---',$v['level']*2)}}{{$v->cate_name}}</option>
				@endforeach
			</select></td>
		</tr>
		<tr>
			<td>商品品牌</td>
			<td>
				<select name="brand_id">
					@foreach($brandinfo as $v)
					<option value="{{$v->id}}"  @if($v->id==$data->brand_id) selected @endif>{{$v->bname}}</option>
					@endforeach
				</select>
			</td>
		</tr>
		<tr>
			<td><input type="submit" value="修改"></td>
			<td></td>
		</tr>
	</table>
</form>