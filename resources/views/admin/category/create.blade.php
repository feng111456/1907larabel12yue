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
        <h3 align='center'>分类添加</h3>
        <form class="form-horizontal" role="form" method='post' action="{{url('category/store')}}   " >
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" 
                name='cate_name'  placeholder="请输入分类名称">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否显示</label>
            <div class="col-sm-10">
                <input type="radio" id="lastname" 
                name='cate_show' value='1' checked >是
                <input type="radio"  id="lastname" 
                name='cate_show' value='2'>否
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否导航显示</label>
            <div class="col-sm-10">
                <input type="radio"  id="lastname" 
                name='cate_nav_show' value='1'>是
                <input type="radio"  id="lastname" 
                name='cate_nav_show' value='2' checked>否
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">所属分类</label>
            <div class="col-sm-10">
                    <select name="parent_id" >
                         <option value=0>==请选择==</option>
                         @foreach($cateInfo as $v)
                         <option value="{{$v->cate_id}}">{{str_repeat('==',$v['lv']-1)}}{{$v->cate_name}}</option>
                         @endforeach
                    </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-danger">分类添加</button>
            </div>
        </div>
    </form>
</body>
</html>