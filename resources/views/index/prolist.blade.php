@extends('layouts.layout')
    @section('title', '商品详情') 
    @section('content') 
    <script src='/jq.js'></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      @foreach($goodsInfo->goods_imgs as $v)
      <img src="{{env('UPLOAD_URL')}}{{$v}}" />
      @endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
      <th><strong class="orange">单价：</strong></th>
       <th><strong class="orange">{{$goodsInfo->goods_price}}</strong></th>
       <td>
        <input type="button" id='jian' value="-">
        <input type="text" id='buy_number' value="1"/>
        <input type="button" id='jia' value="＋">
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$goodsInfo->goods_name}}</strong>
        
        <p class="hui">库存:{{$goodsInfo->goods_num}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <table class="jrgwc">
      <tr>
       <th>
        <a href="javascript:;"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="javascript:;" id='car'>加入购物车</a></td>
      </tr>
     </table>
     <div class="height2"></div>
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
    <img src="{{env('UPLOAD_URL')}}{{$goodsInfo->goods_img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     
    </div><!--maincont-->
	</script>
     <!--jq加减-->
    <script src="{{asset('/static/index/js/jquery.spinner.js')}} "></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
  @include('public.footer');
  <script>  
        $("#jia").click(function(){
            var _value = parseInt($("#jia").prev('input').val());
            var goods_num = {{$goodsInfo->goods_num}};
            var goods_number = parseInt(goods_num);
            if(_value>=goods_number){
              $("#jia").prev('input').val(goods_number);
            }else{
              var _value2 =_value+1;
              $("#jia").prev('input').val(_value2);
            }
            
        })
        $("#jian").click(function(){
            var _value = parseInt($("#jian").next('input').val());
            if(_value<=1){
              $("#jian").next('input').val(1);
            }else{
              var _value2 =_value-1;
              $("#jian").next('input').val(_value2);
            }
           
        })
        $("#car").click(function(){
            var goods_id = {{$goodsInfo->goods_id}};
            var buy_number = $("#buy_number").val();
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.post(
                  "{{url('/car_add')}}",
                  {goods_id:goods_id,buy_number:buy_number},
                  function(res){
                      if(res.code==3){
                        alert(res.font)
                        location.href="{{url('/login')}}";
                      }else if(res.code==2){
                        alert(res.font)
                        location.href="{{url('/prilist')}}/"+goods_id;
                      }else if(res.code==1){
                        alert(res.font)
                        location.href="{{url('/car')}}";
                      }
                  },'json'   
            )
        })
  </script>
  @endsection