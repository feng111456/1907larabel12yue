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
    <h3 align='center'><b style='color:red'>管理员登录</b></h3>
<form class="form-horizontal" role="form" method='post' action="{{url('login/LoginDo')}}">
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员账号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				name='name'  placeholder="请输入管理员账号">
		</div>
        @csrf;
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" 
                name='password'  placeholder="请输入管理员密码">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-success">登录</button>
		</div>
	</div>
</form>
</body>
</html>