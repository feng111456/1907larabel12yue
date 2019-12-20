<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Admin as admin_model;
class Admin extends Controller
{
    /**管理员展示 */
    public function index()
    {
        //接收筛选值
        $account = request()->account;
        $where = [];
        if(!empty($account)){
            $where[] = ['account','like',"%$account%"];
        }
        $info = admin_model::where($where)->get();
        return view('admin/admin/index',['info'=>$info]);
    }

    /**管理员添加 */
    public function create()
    {
        return view('admin/admin/create');
    }

    /**管理员添加执行 */
    public function store(Request $request)
    {
        //接收值
        $data = $request->except('_token');
        if(request()->hasFile('img')){
            $img = $this->upload('img');
            $data['img']=$img;
        }else{
            echo "<script>alert('文件上传有误');location.href='/admin/create'</script>";die;
        }
        $res = admin_model::create($data);
        if($res){
            echo "<script>alert('成功');location.href='/admin/index'</script>";
        }else{
            echo "<script>alert('失败');location.href='/admin/create'</script>";
        }
    }

    /**管理员详细展示 */
    public function show($id)
    {
        //
    }

    /**管理员修改form */
    public function edit($id)
    {
      $info = admin_model::find($id);
      return view('admin/admin/edit',['info'=>$info]); 
    }

    /**管理员修改执行 */
    public function update(Request $request, $id)
    {
         //接收值
         $data = $request->except('_token');
         if(request()->hasFile('img')){
             $img = $this->upload('img');
             $data['img']=$img;
         }
         $res = admin_model::where('id',$id)->update($data);
         if($res){
             echo "<script>alert('成功');location.href='/admin/index'</script>";
         }else{
             echo "<script>alert('失败');location.href='/admin/edit/'.$id</script>";
         }
    }

    /**管理员的删除 */
    public function destroy($id)
    {
        $res = admin_model::destroy($id);
        if($res){
            echo "<script>alert('成功');location.href='/admin/index'</script>";
        }else{
            echo "<script>alert('失败');location.href='/admin/index'</script>";
        }

    }
    /**文件上传 */
    public function upload($img){
        if (request()->file($img)->isValid()){
            $photo = request()->file($img);
            $store_result = $photo->store('img');
            //$store_result = $photo->storeAs('photo', 'test.jpg');
            return $store_result;
            }
    }
}
