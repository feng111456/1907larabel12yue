@extends('layouts.layout')
    @section('title', '购物车') 
    @section('content') 
    <script src='/jq.js'></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
  
     
     <div class="dingdanlist">
      <table>
      <tr>
        <td width="100%" colspan="4"><a href="javascript:;" id="all"><input type="checkbox" id="Allbox" name="1" /> 全选</a></td>
       </tr>
      @foreach($info as $v)
       <tr goods_id="{{$v->goods_id}}">
        <td width="4%"><input type="checkbox" class='box' name="1" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}"/></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>{{date('Y-m-d h:i:s',$v->add_time)}}</time>
        </td>
        <td width="50%">
         <h3>商品小计</h3>
         <strong class="orange">¥{{$v->goods_price*$v->buy_number}}</strong>
        </td>
        <td>
        <input type="button" class='jia' value="➕" style="width:30px">
        <input class="buy_number" goods_num="{{$v->goods_num}}" value="{{$v->buy_number}}" type="text" size="15" style="text-align:center;vertical-align:middel;width:30px;height:27px;"/>
        <input type="button" class='jian' value="➖" style="width:30px">
        </td>
       </tr>
       @endforeach
       <tr>
        <td width="100%" colspan="4"><input type="button" value='删除' id="del"></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="allprice">¥0</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan" id='buy'>去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <script src="{{asset('/static/index/js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('/static/index/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/static/index/js/style.js')}}"></script>

	  
  </body>
</html>
<script>
    $(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
          /**点击结算 */
          $("#buy").click(function(){
            //获取选中的复选框
            var box = $('.box:checked');
            if(box.length>0){
              var goods_id = '';
              box.each(function(index){
                 goods_id += $(this).parents('tr').attr('goods_id')+',';
              })
              goods_id=goods_id.substr(0,goods_id.length-1);
              location.href="{{url('/pay')}}?goods_id="+goods_id;
            }else{
              alert('请至少选择一件商品');
            }
          })
          //当前点击的复选框
          $(document).on('click','.box',function(){
              var _this = $(this)
              var goods_id = _this.parents('tr').attr('goods_id');
              var status = _this.prop('checked');
              if(status==true){
                changePrice(goods_id,_this)
                changeAllPrice()
              }else{
                changeAllPrice()
              }
          })
          /**点击全选 */
          $(document).on('click',"#Allbox",function(){
                var status = $("#Allbox").prop('checked');
                if(status == true){
                    $('.box').prop('checked',status);
                     changeAllPrice()
                }else{
                    $('.box').prop('checked',status);
                    
                   changeAllPrice()
                }
          })
          /**点击加号 */
          $(".jia").click(function(){
              var _this=$(this)
              var buy_number = parseInt(_this.next().val());
              var goods_num = parseInt(_this.next().attr('goods_num'));
              var goods_id = _this.parents('tr').attr('goods_id');
                if(buy_number>=goods_num){
                    _this.next().val(goods_num)
                }else{
                  buy_number+=1
                  _this.next().val(buy_number)
                }
                buy_number = _this.next().val();
                changeBuy_bumber(_this,buy_number,goods_id)  
                changeCheckbox(_this);
                changePrice(goods_id,_this)
                changeAllPrice()
            })
          /**点击减号 */
          $(".jian").click(function(){
              var _this=$(this)
              var buy_number = parseInt(_this.prev().val());
              var goods_id = _this.parents('tr').attr('goods_id');
                if(buy_number<=1){
                    _this.next().val(1)
                }else{
                  buy_number-=1
                  _this.prev().val(buy_number)
                }
                buy_number = _this.prev().val();
                changeBuy_bumber(_this,buy_number,goods_id)    
                changeCheckbox(_this)
                changePrice(goods_id,_this) 
                changeAllPrice()
          }) 
          /**点击删除 */
          $("#del").click(function(){
            var box = $('.box:checked');
            var goods_id ='';
            box.each(function(index){
                goods_id+=$(this).parents('tr').attr('goods_id')+',';
              })
              var goods_id=goods_id.substr(0,goods_id.length-1)
              $.post(
                    "{{url('/del')}}",
                    {goods_id:goods_id},
                    function(res){
                      box.each(function(index){
                          $(this).parents('tr').remove();
                      })
                      $("#allprice").text('￥0');
                    }
              )
          })
          /**购买数量改变 */
          function changeBuy_bumber(_this,buy_number,goods_id){
              $.ajax({
                method:"post",
                url:"{{url('/changeBuy_bumber')}}",
                data:{buy_number:buy_number,goods_id:goods_id},
                async:false
              }).done(function(res){
                if(res==1){
                    _this.next().val(buy_number);
                  }    
              })
          }
          /**当前点击的行选中 */
          function changeCheckbox(_this){
              _this.parents('tr').find('.box').prop('checked',true)
            }
          /**获取小计 */
          function changePrice(goods_id,_this){
            $.post(
                    "{{url('/changePrice')}}",
                    {goods_id:goods_id},
                    function(res){
                      _this.parents('tr').find('.orange').text('￥'+res);
                    }
                )
            }
          /**获取总价 */
          function changeAllPrice(){
            var box = $('.box:checked');
            var goods_id ='';
            box.each(function(index){
                goods_id+=$(this).parents('tr').attr('goods_id')+',';
              })
              var goods_id=goods_id.substr(0,goods_id.length-1)
              $.post(
                    "{{url('/AllPrice')}}",
                    {goods_id:goods_id},
                    function(res){
                      $("#allprice").text('￥'+res);
                    }
              )
          }
    })
</script>
@endsection