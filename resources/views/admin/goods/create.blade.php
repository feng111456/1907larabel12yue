<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css"> 
    <title>Document</title>
</head>
<body>
        
                <div class="row">
                
                <h3 style='color:red' align='center '><a href="" class="btn btn-success" align='right'>商品添加</a>|<a href="{{url('goods/index')}}" class="btn btn-success" align='right'>商品展示</a> </h3>

                <h1>==========================================================================</h1>
                    <div class="col-xs-12">
                        <form class="form-horizontal" role="form" method="post" action="{{url('goods/store')}}" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品名称</label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-1" name="goods_name" placeholder="商品名称" class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>
                                @csrf
                                <div class="space-4"></div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">价格</label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-2" placeholder="价格"  name="goods_price" class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">库存</label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-2" placeholder="库存"  name="goods_num" class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">积分</label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-2" placeholder="积分"  name="goods_jifen" class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">新品</label>

                                    <div class="col-sm-9">
                                        <input type="radio" value="1"  name="is_new" checked />是
                                        <input type="radio" value="2"  name="is_new"  />是
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">精品</label>

                                    <div class="col-sm-9">
                                        <input type="radio" value="1"  name="is_best" checked />是
                                        <input type="radio" value="2"  name="is_best"  />是
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">热卖</label>

                                    <div class="col-sm-9">
                                        <input type="radio" value="1"  name="is_host" checked />是
                                        <input type="radio" value="2"  name="is_host"  />是
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">上架</label>

                                    <div class="col-sm-9">
                                        <input type="radio" value="1"  name="is_up" checked />是
                                        <input type="radio" value="2"  name="is_up"  />是
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">详情</label>

                                    <div class="col-sm-9">
                                        <textarea name="goods_desc" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">图片</label>

                                    <div class="col-sm-9">
                                        <input type="file" id="form-field-2" placeholder="图片"  name="goods_img[]" class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">相册</label>

                                    <div class="col-sm-9">
                                        <input type="file" id="form-field-2" placeholder="图片"  name="goods_imgs[]" class="col-xs-10 col-sm-5" multiple />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">分类</label>

                                    <div class="col-sm-9">
                                        <select name="cate_id">
                                            <option value="">==请选择==</option> 
                                            @foreach($cateInfo as $v)
                                            <option value="{{$v->cate_id}}">{{str_repeat('==',$v['lv']-1)}}{{$v->cate_name}}</option>
                                            @endforeach         
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">品牌</label>

                                    <div class="col-sm-9">
                                        <select name="brand_id">
                                            <option value="0">--请选择--</option>
                                            @foreach($brandInfo as $v)
                                            <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                                            @endforeach                                    
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" type="submit">
                                            <i class="icon-ok bigger-110"></i>
                                            增加
                                        </button>

                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="icon-undo bigger-110"></i>
                                            重置
                                        </button>
                                    </div>
                                </div>
                            <div class="hr hr-24"></div>
                        </form>
                    </div><!-- /span -->
                </div>
</body>
</html>