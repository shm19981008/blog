<form action="{{url('/goods/store')}}" method="post" enctype="multipart/form-data">
	@csrf
	<h3>商品添加页面</h3>
	<table>
		<tr>
			<td>商品名称</td>
			<td><input type="text" name="goods_name">
				<b style="color:red">{{$errors->first('goods_name')}}</b>
			</td>
		</tr>
		<tr>
			<td>商品价格</td>
			<td><input type="text" name="goods_price">
				<b style="color:red">{{$errors->first('goods_price')}}</b>
			</td>
		</tr>
		<tr>
			<td>商品图片</td>
			<td><input type="file" name="goods_img"></td>
		</tr>
		<tr>
			<td>商品库存</td>
			<td><input type="text" name="goods_num"></td>
		</tr>
		<tr>
			<td>是否精品</td>
			<td><input type="radio" name="is_best" value="1" checked>是
				<input type="radio" name="is_best" value="2">否
			</td>
		</tr>
		<tr>
			<td>是否热卖</td>
			<td><input type="radio" name="is_hot" value="1">是
				<input type="radio" name="is_hot" value="2" checked>否
			</td>
		</tr>
		<tr>
			<td>商品介绍</td>
			<td><textarea name="goods_desc"></textarea></td>
		</tr>
		<tr>
			<td>商品相册</td>
			<td><input type="file" name="goods_imgs[]" multiple="multiple"></td>
		</tr>
		<tr>
			<td>商品分类</td>
			<td><select name="cate_id">
				@foreach($info as $v)
				<option value="{{$v->cate_id}}">{{str_repeat('---',$v['level']*2)}}{{$v->cate_name}}</option>
				@endforeach
			</select></td>
		</tr>
		<tr>
			<td>商品品牌</td>
			<td>
				<select name="brand_id">
					@foreach($brandinfo as $v)
					<option value="{{$v->id}}">{{$v->bname}}</option>
					@endforeach
				</select>
			</td>
		</tr>
		<tr>
			<td><input type="submit" value="添加"></td>
			<td></td>
		</tr>
	</table>
</form>