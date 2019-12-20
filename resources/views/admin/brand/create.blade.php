<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">  
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
        <h3 align='center'>品牌添加</h3>
        <form class="form-horizontal" role="form" id="form" method='post' action="{{url('brand/store')}}" enctype="multipart/form-data" >
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" 
                name='brand_name'  placeholder="请输入品牌名称"><b style='color:red'>{{$errors->first('brand_name')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="brand_url" 
                name='brand_url'  placeholder="请输入品牌网址">
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
                <textarea name="brand_desc"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-danger">品牌添加</button>
            </div>
        </div>
    </form>
</body>
</html>
<script src="/jq.js"></script>

<script>
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $(function(){
        $("#firstname").blur(function(){
            checkName();
        })
        $("#brand_url").blur(function(){
            checkUrl();
        })
        $("#form").submit(function(){
            var res =checkName();
            var res2 =checkUrl();
            return res && res2;
        })
        function checkName(){
            var brand_name = $("#firstname").val();
            var reg = /^[\u4e00-\u9fa5\w]{2,}$/;
            if(!reg.test(brand_name)){
                $("#firstname").next().text('品牌允许中文数字字母下划线注册长度为最少2位')
                return false;
            }else{
                var filg = true;
                $.ajax({
                    method:"post",
                    url:"{{url('brand/checkName')}}",
                    data:{brand_name:brand_name},
                    async:false
                }).done(function(res){
                    if(res==1){
                        $("#firstname").next().text('该品牌已存在')
                        filg = false;
                    }
                })
                return filg;
            }
        }
        function checkUrl(){
                var brand_url =$("#brand_url").val();
                var reg = /^http:\/\/+/;
                if(!reg.test(brand_url)){
                    $("#brand_url").next().text('品牌网址必须为 "http://开头最少1位数"');
                    return false;
                }else{
                    return true;
                }
        }
    })
</script>