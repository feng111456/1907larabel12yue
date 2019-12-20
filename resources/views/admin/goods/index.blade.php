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
<div class="table-responsive">
        <h3  align='center'><a href="" class="btn btn-success" align='right'>商品展示</a>|
        <a href="{{url('goods/create')}}" class="btn btn-success" align='right'>商品添加</a></h3>

	<table class="table">
		<thead>
			<tr>
				<th>商品ID</th>
				<th>商品名称</th>
                <th>商品单价</th>
                <th>商品库存</th>
                <th>图片</th>
                <th>相册</th>
                <th>描述</th>
                <th>新品</th>
                <th>精品</th>
                <th>热卖</th>
                <th>分类</th>
                <th>品牌</th>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
            @foreach($goodsInfo as $v)
			<tr>
				<td>{{$v->goods_id}}</td>
                <td>{{$v->goods_name}}</td>
                <td>{{$v->goods_price}}</td>
				<td>{{$v->goods_num}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width='85px'></td>
                <td>
                @foreach($v->goods_imgs as $vv)
                <img src="{{env('UPLOAD_URL')}}{{$vv}}" width='85px'>
                @endforeach
                </td>
                
                <td>{{$v->goods_desc}}</td>
                <td>{{$v->is_new}}</td>
                <td>{{$v->is_best}}</td>
                <td>{{$v->is_host}}</td>
                <td>{{$v->cate_name}}</td>
                <td>{{$v->brand_name}}</td>
                <td>
                    <a href="{{url('goods/destroy/'.$v->goods_id)}}" class="btn btn-success" >删除</a>
                    <a href="{{url('goods/edit/'.$v->goods_id)}}" class="btn btn-success" >修改</a>
                </td>
            </tr>
            @endforeach
		</tbody>
</table>


</div> 
</body>
</html>