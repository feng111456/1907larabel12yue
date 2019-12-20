<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category as cate_model;

class Category extends Controller
{
    //分类展示
    public function index()
    {
        $cate_name = request()->cate_name;
        $where = [];
        if(!empty($cate_name)){
            $where[] = ['cate_name','like',"%$cate_name%"];
        }
        $res = cate_model::where($where)->get();
        $cateInfo = $this->get_cate($res);
       //  dd($cateInfo);
        return view('admin/category/index',['cateInfo'=>$cateInfo]);
    }

    /**分类添加视图 */
    public function create()
    {
        $res = cate_model::all();
        $cateInfo = $this->get_cate($res);
        return view('admin/category/create',['cateInfo'=>$cateInfo]);
    }

    /**分类添加执行 */
    public function store()
    {
        //接收值
        $data = request()->except('_token');
        $res = cate_model::create($data);
        if($res){
            echo "<script>alert('成功');location.href='/category/index'</script>";
        }else{
            echo "<script>alert('失败');location.href='/category/create'</script>";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Info = cate_model::find($id);
        $res = cate_model::all();
        $cateInfo = $this->get_cate($res);
        return view('admin/category/edit',['cateInfo'=>$cateInfo,'info'=>$Info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //接收值
         $data = request()->except('_token');
         $res = cate_model::where('cate_id',$id)->update($data);
         if($res){
             echo "<script>alert('成功');location.href='/category/index'</script>";
         }else{
             echo "<script>alert('失败');location.href='/category/create'</script>";
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = cate_model::destroy($id);
        if($res){
            echo "<script>alert('成功');location.href='/category/index'</script>";
        }else{
            echo "<script>alert('失败');location.href='/category/index'</script>";
        }
    }
    //无限级分类
    function get_cate($res,$parent_id=0,$lv=1)
    {
        static 	$array =[];
        foreach($res as $v){
            if($v['parent_id']==$parent_id){
                $v['lv'] =$lv;
                $array[]=$v;	
                $this->get_cate($res,$v['cate_id'],$v['lv']+1);
            }
        }
        return $array;
    }
}
