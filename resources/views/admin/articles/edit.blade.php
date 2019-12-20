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
        <h3 align='center'>文章修改</h3>
        <form class="form-horizontal" role="form" method='post' action="{{url('articles/update/'.$arInfo->id)}}" enctype="multipart/form-data" >
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">文章标题</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" 
                name='a_title' value='{{$arInfo->a_title}}' placeholder="请输入文章标题">
                <b style='color:red'>{{$errors->first('a_title')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">分类</label>
            <div class="col-sm-10">
                <select name="c_id">
                <option value="">--请选择--</option>
                @foreach($cateInfo as $v)
                <option value="{{$v->c_id}}" {{$arInfo->c_id==$v->c_id?'selected':''}}>=={{$v->c_name}}</option>
                @endforeach
                </select>
                <b style='color:red'>{{$errors->first('c_id')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">文章重要性</label>
            <div class="col-sm-10">
                <input type="radio" name='a_importance' value='1' {{$arInfo->a_importance==1?'checked':''}}>普通
                <input type="radio" name='a_importance' value='2' {{$arInfo->a_importance==2?'checked':''}}>置顶
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">是否显示</label>
            <div class="col-sm-10">
                <input type="radio" name='is_show' value='1' {{$arInfo->is_show==1?'checked':''}}>是
                <input type="radio" name='is_show' value='2' {{$arInfo->is_show==2?'checked':''}}>否
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">文章作者</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" 
                name='a_author' value='{{$arInfo->a_author}}'  placeholder="请输入文章作者">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">作者email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" 
                name='a_email' value='{{$arInfo->a_email}}'  placeholder="作者邮箱">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">关键字</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" 
                name='a_keywords' value='{{$arInfo->a_keywords}}'   placeholder="关键字">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">文章描述</label>
            <div class="col-sm-10">
                <textarea name="a_desc" id="" cols="30" rows="10">{{$arInfo->a_desc}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">上传文件</label>
            <div class="col-sm-10">
                
                <img src="{{env('UPLOAD_URL')}}{{$arInfo->img}}" width='85px'>
                <input type="file" class="form-control" id="lastname" name='img[]'>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-danger">文章修改</button>
            </div>
        </div>
    </form>
</body>
</html>