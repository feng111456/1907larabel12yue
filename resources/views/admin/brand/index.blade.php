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
        <h3  align='center'>品牌展示</h3>
        <form>
            品牌名称 ：<input type="text" name='brand_name' value='{{request()->brand_name}}'>--
            品牌网址 ：<input type="text" name='brand_url' value='{{request()->brand_url}}'>
            <input type="submit" value='筛选'>
        </form>
	<table class="table">
		<thead>
			<tr>
				<th>品牌ID</th>
				<th>品牌名称</th>
                <th>品牌网址</th>
                <th>品牌logo</th>
                <th>品牌介绍</th>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
            @foreach($info as $v)
			<tr>
				<td>{{$v->brand_id}}</td>
				<td>{{$v->brand_name}}</td>
                <td>{{$v->brand_url}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width='85px'></td>
				<td>{{$v->brand_desc}}</td>
                <td>
                    <a href="{{url('brand/destroy/'.$v->brand_id)}}" class="btn btn-success" >删除</a>
                    <a href="{{url('brand/edit/'.$v->brand_id)}}" class="btn btn-success" >修改</a>
                </td>
            </tr>
            @endforeach
		</tbody>
</table>
{{ $info->appends($query)->links()}}
<a href="{{url('brand/create')}}" class="btn btn-success" align='right'>品牌添加</a>
</div> 
</body>
</html>