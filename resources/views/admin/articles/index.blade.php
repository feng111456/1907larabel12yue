<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">  
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>      
<div class="table-responsive">
        <h3  align='center'>文章展示</h3>
        <form>
            分类 ：
                <select name="c_id">
                    <option value="">--请选择--</option>
                    @foreach($cateInfo as $v)
                    <option value="{{$v->c_id}}" {{request()->c_id==$v->c_id?'selected':''}}>=={{$v->c_name}}</option>
                    @endforeach
                </select>
            文章标题 ：<input type="text" name='a_title' value='{{request()->a_title}}'>
            <input type="submit" value='筛选'>
        </form>
	<table class="table">
		<thead>
			<tr>
				<th>文章编号</th>
				<th>文章标题</th>
                <th>文章分类</th>
                <th>文章重要性</th>
                <th>是否显示</th>
                <th>添加时间</th>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
            @foreach($arInfo as $v)
			<tr a_id ="{{$v->id}}" >
				<td>{{$v->id}}</td>
				<td>{{$v->a_title}}</td>
                <td>{{$v->c_name}}</td>
                <td>{{$v->a_importance==1?'普通':'重要'}}</td>
                <td>{{$v->is_show ==1?'√':'×'}}</td>
                <td>{{$v->add_time}}</td>
                <td>
                    <a href="javascript:;" class="btn btn-success del" >删除</a>
                    <a href="{{url('articles/edit/'.$v->id)}}" class="btn btn-success" >修改</a>
                </td>
            </tr>
            @endforeach
		</tbody>
</table>
{{ $arInfo->appends($query)->links()}}
<a href="{{url('articles/create')}}" class="btn btn-success" align='right'>文章添加</a>
</div> 
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
            $(document).on('click','.del',function(){
                var _this =$(this);
                var id = _this.parents('tr').attr('a_id');
                    $.post(
                        "{{url('articles/destroy')}}",
                        {id:id},
                        function(res){
                           if(res==1){
                                alert('删除成功');
                                _this.parents('tr').remove();
                           }else{
                                alert('删除失败');
                           }
                        }
                    )
            })
    })
</script>