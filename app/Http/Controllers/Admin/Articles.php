<?php

namespace App\Http\Controllers\Admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Cate as cate_model;
use App\Model\Admin\Articles as ar_model;
use Illuminate\Validation\Rule;
class Articles extends Controller
{
    /** 文章列表页面*/
    public function index()
    {
        //查询分类表写活下拉菜单
        $cateInfo = cate_model::all();
        //接收筛选数据 写查询where条件
        $c_id = request()->c_id;
        $a_title = request()->a_title;
        $where = [];
        if(!empty($c_id)){
            $where[] = ['articles.c_id','=',$c_id];
        }
        if(!empty($a_title)){
            $where[] = ['a_title','like',"%$a_title%"];
        }
        //查询文章表数据
        $arInfo = ar_model::leftjoin('cate as c','articles.c_id','=','c.c_id')->where($where)->paginate(2);
        foreach($arInfo as $k=>$v){
        $arInfo[$k]->add_time = date('Y-m-d h:i:s',$v->add_time);
        }
        $query = request()->all();
        return view('admin/articles/index',['cateInfo'=>$cateInfo,'arInfo'=>$arInfo,'query'=>$query]);
    }
    /** 文章添加视图*/
    public function create()
    {
        //查询分类表写活下拉菜单
        $cateInfo = cate_model::all();
        return view('admin/articles/create',['cateInfo'=>$cateInfo]);
    }

    /**文章添加执行 */
    public function store(Request $request)
    {
        $data =$request->except('_token');
        if($file = $request->file('img')){;
            $img =upload($file);
            $img =  implode('|',$img); 
            $data['img']=$img;
        }
        $validator = Validator::make($data, [
            'a_title' =>
             ['required',
             'unique:articles',
             'regex:/^[\u4e00-\u9fa5\w_]{1,10}$/u',
            ],
            'c_id' => 'required',
            'is_hsow' => 'required',
            'a_importance' => 'required',
        ],[
            'a_title.required'  =>'标题名称必填',
            'a_title.unique'    =>'标题已存在',
            'a_title.regex'     =>'标题必须以中文字母数字下划线组成，1-10位',
            'c_id.required'     =>'分类必选', 
        ]);
        if ($validator->fails()) {
            return redirect('articles/create')
            ->withErrors($validator)
           ->withInput();
        }
        $data['add_time']=time();
        //dd($data);
        $res = ar_model::create($data);
        if($res){
            echo "<script>alert('成功');location.href='/articles/index'</script>";
        }else{
            echo "<script>alert('失败');location.href='/articles/create'</script>";
        }
    }

    /**文章详情页面 */
    public function show($id)
    {
        //
    }

    /** 文章修改form*/
    public function edit($id)
    {
        $arInfo = ar_model::find($id);
        //查询分类表写活下拉菜单
        $cateInfo = cate_model::all();
        return view('admin/articles/edit',['cateInfo'=>$cateInfo,'arInfo'=>$arInfo]);
    }

    /**文章修改执行页面 */
    public function update(Request $request, $id)
    {
        $data =$request->except('_token');
        $validator = Validator::make($data,[
            'a_title' =>
            [
            'required',
            Rule::unique('articles')->ignore($id),
            'regex:/^[\u4e00-\u9fa5\w_]{1,10}$/u',
            ],
            'c_id' => 'required',
            'is_show' => 'required',
            'a_importance' => 'required',
       ],[
            'a_title.required'  =>'标题名称必填',
            'a_title.unique'    =>'标题已存在',
            'a_title.regex'     =>'标题必须以中文字母数字下划线组成，1-10位',
            'c_id.required'     =>'分类必选', 
       ]);
       if ($validator->fails()){
            return redirect('articles/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        if($file = $request->file('img')){;
            $img =upload($file);
            $img =  implode('|',$img); 
            $data['img']=$img;
        }
        
        $data['add_time']=time();
        //dd($data);
        $res = ar_model::where('id',$id)->update($data);
        if($res!==false){
            echo "<script>alert('成功');location.href='/articles/index'</script>";
        }else{
            echo "<script>alert('失败');location.href='/articles/edit/'.$id</script>";
        }
    }

    /**文章删除页面 */
    public function destroy()
    {
        $id = request()->id;
        $res = ar_model::destroy($id);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    /**检测唯一 */
    function check(){
        //接收值
        $value = request()->_value;
        $count = ar_model::where('a_title',$value)->count();
        if($count>0){
            echo 1;
        }else{
            echo 2;
        }
    }
}
