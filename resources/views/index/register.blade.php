   @extends('layout.shop')
    @section('title', '首页')
    @section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>           
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />dd
     </div><!--head-top/-->
     <form action="{{url('/shop/do_register')}}" method="post" class="reg-login">
      @csrf
      <h3>已经有账号了？点此<a class="orange" href="login.html">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="输入手机号码或者邮箱号" class="moblie" name="mobile"/></div>
       <div class="lrList2"><input type="text" placeholder="输入短信验证码" name="code" /> <button type="button">获取验证码</button></div>
       <div class="lrList"><input type="text" placeholder="设置新密码（6-18位数字或字母）"name="pwd" /></div>
       <div class="lrList"><input type="text" placeholder="再次输入密码" name="repwd" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
       
     @endsection
     <script type="text/javascript" src="/static/jquery.min.js"></script>
     <script>
          $(function(){
            $("button").click(function(){
              var mobile=$(".moblie").val();
              if(!mobile){
                alert('请输入手机号或邮箱');
                return;
              }
              $.get(
                '/ajaxsend',
                {mobile:mobile},
                'json',
                function(res){
                  console.log(res);
                }
                )
            })
          })
     </script>