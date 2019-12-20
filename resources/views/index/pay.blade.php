@extends('layouts.layout')
    @section('title', '购物车') 
    @section('content') 
    <script src='/jq.js'></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <div class="dingdanlist" style="height: 200px;border: 2px solid red; overflow: auto" id="site" >
        @if(empty($addInfo))
          <tr>
            <td class="dingimg" width="75%" colspan="2"><a href="{{url('/address')}}" style="color:#0f0; font-size:30px" >新增收货地址</a></td> 
          </tr> 
        @else
          @foreach($addInfo as $v)
          <table border="0" class="peo_tab" style="width:550px;" cellspacing="0" cellpadding="0">
                  <tr>
                    <td rowspan="2"><input type="radio" name="site"  address_id="{{$v['address_id']}}"></td>
                    <td class="p_td" width="160">收件人</td>
                    <td width="395">{{$v['man']}}</td>
                    <td class="p_td" width="160">电话</td>
                    <td width="395">{{$v['tel']}}</td>
                  </tr>
                  <tr>
                    <td class="p_td">详细信息</td>
                    <td>{{$v['province']}},{{$v['city']}},{{$v['area']}},{{$v['site']}}</td>
                  </tr>
                </table><br>
          @endforeach    
        @endif
           
      </div>
      <div class="dingdanlist">
      <table>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">支付方式</td>
        <td align="right">
          <select id="pay_method">
                <option value="2">微信</option>
                <option value="1" selected>支付宝</option>
          </select>
        </td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
      
       <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="3">商品清单</td>
       </tr>
       
      @foreach($cartInfo as $v)
       <tr>
        <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v['goods_img']}}" /></td>
        <td width="50%">
         <h3>{{$v['goods_name']}}</h3>
         <time>{{date('Y-m-d h:i:s',$v['add_time'])}}</time>
        </td>
        <td width="50%">
         <h3>小计</h3>
         <time><strong class="orange">￥{{$v['goods_price']*$v['buy_number']}}</strong></time>
        </td>
        <td align="right"><span class="qingdan">X{{$v['buy_number']}}</span></td>
       </tr>
       @endforeach
       <tr>
        <td class="dingimg" width="75%" colspan="2">总金额</td>
        <td align="right"><strong class="orange">¥{{$Allprice}}</strong></td>
       </tr>
       </table>
     </div><!--dingdanlist/-->
     
     
    </div><!--content/-->
    
    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">¥{{$Allprice}}</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">提交订单</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
    <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
</html>
<script>
      $('.jiesuan').click(function(){
        var goods_id = "{{request()->goods_id}}"
        var pay_method = $("#pay_method").val();
        var address_id = $("#site").find(':radio:checked').attr('address_id');
          if(address_id===undefined){
            alert('请至少选择一个收货地址');
          }
        location.href="{{url('subOrder')}}?goods_id="+goods_id+"&pay_method="+pay_method+"&address_id="+address_id;
      })
</script>
@endsection