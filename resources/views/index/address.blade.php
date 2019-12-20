@extends('layouts.layout')
    @section('title', '购物车') 
    @section('content') 
    <script src='/jq.js'></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/add')}}" method="post" class="reg-login">
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="收货人" name="man"/></div>
       @csrf
       <div class="lrList">
        <select class="area" name="province">
          <option value="">--请选择省份--</option>
        @foreach($areaInfo as $v)
          <option value='{{$v->id}}'>{{$v->name}}</option>
        @endforeach
        </select>
        <select class="area" name="city">
         <option>--请选择--</option>
        </select>
        <select class="area" name="area">
         <option>--请选择--</option>
        </select>
        <div class="lrBox">
        <div class="lrList"><input type="text" placeholder="详细地址" name="site"/></div>
        <div class="lrList">
       </div>
       <div class="lrList"><input type="text" placeholder="手机" name="tel"/></div>
       <div class="lrList2">
                  <select name="is_status" >
                      <option value="1">默认收货地址</option><option value="1">不默认</option>
                  </select>
       </div>

      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="保存" />
      </div>
     </form><!--reg-login/-->
     
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="index.html">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="prolist.html">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car.html">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl class="ftnavCur">
       <a href="user.html">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

  </body>
</html>
<script>
    $(function(){
              $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              //给下拉菜单绑定点击事件
              $(document).on('change','.area',function(){
                    var _this = $(this);
                    _this.nextAll('select').html('<option value="" >--请选择--</option>');
                    var _id = _this.val();
                    $.post(
                        "{{url('/getAddress')}}",
                        {_id:_id},
                        function(res){
                          var _option = "<option value=''>--请选择--</option>";
                          for(var i in res){
                              _option+="<option value='"+res[i].id+"'>"+res[i].name+"</option>";
                          }
                          _this.next('select').html(_option);
                        },'json'
                    )
              })
    })
</script>
@endsection
