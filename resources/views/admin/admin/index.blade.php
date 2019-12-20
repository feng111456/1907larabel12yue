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
        <h3  align='center'>管理员展示</h3>
        <form>
            管理员名称 ：<input type="text" name='account' value='{{request()->account}}' placeholder='管理员关键字'>
            <input type="submit" value='筛选' class="btn btn-success">
        </form>
	<table class="table">
		<thead>
			<tr>
				<th>管理员id</th>
				<th>管理员账户</th>
                <th>管理员头像</th>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
            @foreach($info as $v)
			<tr>
				<td>{{$v->id}}</td>
				<td>{{$v->account}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->img}}" width='85px'></td>
                <td>
                    <a href="{{url('admin/destroy/'.$v->id)}}" class="btn btn-success" >删除</a>
                    <a href="{{url('admin/edit/'.$v->id)}}" class="btn btn-success" >修改</a>
                </td>
            </tr>
            @endforeach
		</tbody>
</table>
<a href="{{url('admin/create')}}" class="btn btn-success" align='right'>管理员添加</a>
</div> 
</body>
</html>