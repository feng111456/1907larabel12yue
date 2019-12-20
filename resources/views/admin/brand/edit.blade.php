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
        <h3 align='center'>品牌修改</h3>
    <form class="form-horizontal" role="form" method='post' action="{{url('brand/update/'.$info->brand_id)}}" enctype="multipart/form-data" >
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" 
                name='brand_name' value='{{$info->brand_name}}' placeholder="请输入品牌名称">
                <b style='color:red'>{{$errors->first('brand_name')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lastname" 
                name='brand_url' value='{{$info->brand_url}}'  placeholder="请输入品牌网址">
                <b style='color:red'>{{$errors->first('brand_url')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">品牌logo</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="lastname" name='brand_logo'>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">品牌介绍</label>
            <div class="col-sm-10">
                <textarea name="brand_desc">{{$info->brand_desc}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-danger">品牌修改</button>
            </div>
        </div>
    </form>
</body>
</html>