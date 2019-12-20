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
        <h3  align='center'><a href="" class="btn btn-success" >分类展示</a>|<a href="{{url('brand/create')}}" class="btn btn-success" align='right'>分类添加</a></h3>
        <form>
            分类名称 ：<input type="text" name='cate_name'>
            <input type="submit"  value='筛选'>
            
        </form>
	<table class="table">
		<thead>
			<tr>
				<th>分类ID</th>
				<th>分类名称</th>
                <th>是否显示</th>
                <th>是否导航显示</th>
                <th>父id</th>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
            @foreach($cateInfo as $v)
			<tr>
				<td>{{str_repeat('》',$v['lv']-1)}}{{$v->cate_id}}</td>
				<td>{{str_repeat('》',$v['lv']-1)}}{{$v->cate_name}}</td>
                <td style='color:red'><b>{{$v->cate_show==1?'√':'×'}}</b></td>
                <td style='color:red'><b>{{$v->cate_nav_show==1?'√':'×'}}</b></td>
				<td>{{$v->parent_id}}</td>
                <td>
                    <a href="{{url('category/destroy/'.$v->cate_id)}}" class="btn btn-success" >删除</a>
                    <a href="{{url('category/edit/'.$v->cate_id)}}" class="btn btn-success" >修改</a>
                </td>
            </tr>
            @endforeach
		</tbody>
</table>

</div> 
</body>
</html>