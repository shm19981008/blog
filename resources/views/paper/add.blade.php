<h3>文章添加页面</h3>
<form action="{{url('/paper/do_add')}}" method="post" enctype="multipart/form-data">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@csrf
	<table>
		<tr>
			<td>文章标题</td>
			<td><input type="text" name="title" class="title"><span style="color:red" class="span">*</span>
			<b style="color:red">{{$errors->first('title')}}</b>
			</td>
		</tr>
		<tr>
			<td>文章分类</td>
			<td><select name="type">
				<option>请选择</option>
				<option>名著</option>
				<option selected>小说</option>
				<option>童话故事</option>
			</select></td>
		</tr>
		<tr>
			<td>文章重要性</td>
			<td><input type="radio" name="important" value="普通" checked>普通
				<input type="radio" name="important" value="置顶">置顶
			</td>
		</tr>
		<tr>
			<td>是否显示</td>
			<td><input type="radio" name="is_show" value="1" checked>显示
				<input type="radio" name="is_show" value="2">不显示</td>
		</tr>
		<tr>
			<td>文章作者</td>
			<td><input type="text" name="people" class="author">
				<b style="color:red">{{$errors->first('title')}}</b>
			</td>
		</tr>
		<tr>
			<td>作者Email</td>
			<td><input type="text" name="email"></td>
		</tr>
		<tr>
			<td>关键字</td>
			<td><input type="text" name="keyword"></td>
		</tr>
		<tr>
			<td>网页描述</td>
			<td><textarea name="desc"></textarea></td>
		</tr>
		<tr>
			<td>上传文件</td>
			<td><input type="file" name="file"></td>
		</tr>
		<tr>
			<td><input type="button" value="提交"></td>
			<td></td>
		</tr>
	</table>
</form>
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script>
		$.ajaxSetup({headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
		var titleflag=true;
		$("input[type='button']").click(function(){
		
			var val=$(".title").val();
			var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
			if(val==''){
				$(".span").html('姓名不能为空');
				return;
			}else{
				$(".span").html('*');
			}
			if(!reg.test(val)){
				$(".span").html('标题由数字字母下划线组成');
				return;
			};
			//验证唯一性
			$.ajax({
				type:'post',
				url:"/paper/checkonly",
				data:{val:val},
				async:false,
				dataType:'json',
				success:function(result){
					if(result.count>0){
						$('.span').html('标题已存在');
						titleflag=false;
					}
				}
			})

		
	if(!titleflag){
		return;
	}

	//作者验证
	
		$(".author").blur(function(){
			var author=$(".author").val();
			var reg=/^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
			if(!reg.test(author)){
				$(".author").next().html('文章作者由数字字母下划线组成2-8位');
				return;
			};
			
		})
		//form提交
			$('form').submit();
	})


		
		$(".title").blur(function(){
			var val=$(".title").val();
			var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
			if(val==''){
				$(".span").html('姓名不能为空');
				
			}else{
				$(".span").html('*');
			}
			if(!reg.test(val)){
				$(".span").html('标题由数字字母下划线组成');
				
			};
			//验证唯一性
			$.ajax({
				type:'post',
				url:"/paper/checkonly",
				data:{val:val},
				
				dataType:'json',
				success:function(result){
					if(result.count>0){
						$('.span').html('标题已存在');
						
					}
				}
			})

		})
	
	//作者验证
	
		$(".author").blur(function(){
			var author=$(this).val();
			var reg=/^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
			if(!reg.test(author)){
				$(this).next().html('文章作者由数字字母下划线组成2-8位');
				
			};
			
		})
		
	
</script>