<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">  
</head>
<body>
        <h3 align='center'>管理员添加</h3>
        <form class="form-horizontal" role="form" method='post' action="{{url('admin/store')}}" enctype="multipart/form-data" >
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">管理员账户</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" 
                name='account'  placeholder="请输入管理员账户">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lastname" 
                name='pwd'  placeholder="请输入密码">
               
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">管理员头像</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="lastname" name='img'>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-danger">管理员添加</button>
            </div>
        </div>
    </form>
</body>
</html>