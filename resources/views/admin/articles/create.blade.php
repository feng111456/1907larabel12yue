<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css"> 
    <meta name="csrf-token" content="{{ csrf_token() }}" /> 
</head>
<body>
        <h3 align='center'>管理员添加</h3>
        <form class="form-horizontal" role="form" id='myform' method='post' action="{{url('articles/store')}}" enctype="multipart/form-data" >
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">文章标题</label>
            <div class="col-sm-10">
                <input type="text"  id="firstname" 
                name='a_title'  placeholder="请输入文章标题">
                <b style='color:red'>*</b>
                <b style='color:red'>{{$errors->first('a_title')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">分类</label>
            <div class="col-sm-10">
                <select name="c_id" id='c_id'>
                <option value="">--请选择--</option>
                @foreach($cateInfo as $v)
                <option value="{{$v->c_id}}">=={{$v->c_name}}</option>
                @endforeach
                </select>
                
                <b id=set_b style='color:red'>*</b>
                <b style='color:red'>{{$errors->first('c_id')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">文章重要性</label>
            <div class="col-sm-10">
                <input type="radio" name='a_importance' class='imp' value='1' checked>普通
                <input type="radio" name='a_importance' class='imp' value='2'>置顶
                <b id='imp_b' style='color:red'>*</b>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">是否显示</label>
            <div class="col-sm-10">
                <input type="radio" name='is_show'  class='show222' value='1' checked>是
                <input type="radio" name='is_show'  class='show222' value='2'>否
                <b id='is' style='color:red'>*</b>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">文章作者</label>
            <div class="col-sm-10">
                <input type="text"  id="firstname" 
                name='a_author'  placeholder="请输入文章作者">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">作者email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" 
                name='a_email'  placeholder="作者邮箱">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">关键字</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" 
                name='a_keywords'  placeholder="关键字">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">文章描述</label>
            <div class="col-sm-10">
                <textarea name="a_desc" id="" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">上传文件</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="lastname" name='img[]'>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-danger">文章添加</button>
            </div>
        </div>
    </form>
</body>
</html>
<script src='/jq.js'></script>
<script>
    $(function(){
        $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $(document).on('blur','#firstname',function(){
                checkTitle();
        })
        $(document).on('change','#c_id',function(){
                checkCate();
        })
        $(document).on('submit','#myform',function(){
            var res = checkTitle();
            var res2 = checkImp();
            var res3 = checkIs();
            var res4 = checkCate();
            if(res&&res2&&res3&&res4){
                return true;
            }
            return false;
        })
        /**检测标题 */
        function checkTitle()
        {
            var fl = false;
            var _value = $('#firstname').val();
            var reg = /^[\u4e00-\u9fa5\w]{1,10}$/;
            if(_value==''){
                $('#firstname').next('b').text('标题必填');
                fl = false;
            }else if(!reg.test(_value)){
                $('#firstname').next('b').text('标题必须以中文字母数字下划线组成，1-10位');
                fl = false;
            }else{    
                $.ajax({
                    method:"post",
                    url:"{{url('articles/check')}}",
                    data:{_value:_value},
                    async:false
                }).done(function(res){
                      if(res==1){
                        $('#firstname').next('b').text('该标题已存在');
                        fl = false;
                      }else{
                        $('#firstname').next('b').text('√');
                        fl = true;
                      }  
                })
                return fl; 
            }
        }
        /**检测重要性*/
        function checkImp()
        {
            var imp =$('.imp:checked').length;
            if(imp<1){
                $("#imp_b").text('重要性必选');
                return false;
            }else{
                $("#imp_b").text('√');
                return true;
            }
        }
        /**检测是否显示 */
        function checkIs()
        {
            var is =$('.show222:checked').length;
            console.log(is);
            if(is<1){
                $("#is").text('是否显示必选');
                return false;
            }else{
                $("#is").text('√');
                return true;
            }
        }
        /**检测分类 */
        function checkCate(){
            var set =$("#c_id").val();
            if(set==''){
                $("#set_b").text('分类必选');
                return false;
            }else{
                $("#set_b").text('√');
                return true;
            }
        }
    })
</script>