

<h2>修改页面</h2>
<form  action="{{url('/people/update/'.$user->id)}}" method="post" >
  @csrf
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">名字</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="firstname" placeholder="请输入名字" name="name" value="{{$user->name}}">
    </div>
  </div>
    <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">年龄</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="firstname" placeholder="请输入年龄" name="age" value="{{$user->age}}">
    </div>
  </div>
    <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">身份证号</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="firstname" placeholder="请输入身份证号" name="card" value="{{$user->card}}">
    </div>
  </div>
    <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">是否去过武汉</label>
    <div class="radio">
    <label>
        <input type="radio"  id="optionsRadios1" value="1"  name="is_hubei" value="{{$user->is_hubei== 1 ?'checked':''}}">是

    </label>
    <label>
        <input type="radio"  id="optionsRadios1" value="2"  name="is_hubei" value="{{$user->is_hubei== 2 ?'checked':''}}">否
        
    </label>
    </div>
    
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">头像</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" id="lastname" name="file">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">修改</button>
    </div>
  </div>
</form>

