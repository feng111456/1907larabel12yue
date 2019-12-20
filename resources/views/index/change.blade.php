
        @foreach($goodsInfo as $v)
        <div class="index-pro1-list">
        <dl>
          <dt><a href="{{url('/prolist/'.$v->goods_id)}}"><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="260px" height="136px"/></a></dt>
          <dd class="ip-text"><a href="{{url('/prolist/'.$v->goods_id)}}">{{$v->goods_name}}</a><span>已售：488</span></dd>
          <dd class="ip-price"><strong>{{$v->goods_price}}</strong> <span>¥599</span></dd>
        </dl>
        </div>
        @endforeach
        <div class="clearfix"></div>