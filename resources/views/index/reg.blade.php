@extends('layouts.layout')

@section('title', '会员注册页面')


@section('content')
<script src='/jq.js'></script>
    <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
    <form action="{{url('/reg_add')}}" method="post" class="reg-login" id="myform">
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <div class="lrBox">
        @csrf
       <div class="lrList"><input type="text" id="tel" name='tel' placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name='code' id="code" placeholder="输入短信验证码" /> <button type='button' id="btu">获取验证码</button></div>
       <div class="lrList"><input type="text" name='pwd' id='pwd' placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text" name='pwd2' id='pwd2' placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
    </form><!--reg-login/-->
    @include('public.footer');
    <script>
        //获取验证码
        $("#btu").click(function(){
          var tel = $("#tel").val();
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.post(
                "{{url('/code')}}",
                {tel:tel},
                function(res){
                    if(res==1){
                        alert('发送成功');
                    }else{
                        alert('发送失败');
                    }
                }  
            )

        })
        $("#myform").submit(function(){
          var tel   = $("#tel").val();
          var code  = $("#code").val();
          var pwd  = $("#pwd").val();
          var pwd2  = $("#pwd2").val();
            $.ajaxSetup({
                  headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              })
            var filg = true;
            //检测验证码
            $.ajax({
                method:"post",
                url:"{{url('/checkCode')}}",
                data:{tel:tel,code:code},
                async:false
            }).done(function(res){
                if(res==2){
                  alert('验证码有误');
                  filg = false;
                }
              })
          if(filg===false){
            return false;
          }
          if(pwd!=pwd2){
            alert('两次输入密码不一致');
            filg = false;
          }
          return filg;
        }) 
    </script>
@endsection