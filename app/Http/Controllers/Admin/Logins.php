<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Admin;
class Logins extends Controller
{
    //展示登录视图
    function logins()
    {
        return view('admin/logins/logins');
    }
     /**登录检测页面 */
     function LoginsDo()
     {
         $request = request();
         $adminInfo =$request->except('_token');
         $where = [
             'account'=>$adminInfo['account'],
             'pwd'=>$adminInfo['pwd']
         ];
         $first = Admin::where($where)->first();
 
         if($first){
             session(['admin'=>['account'=>$first['account'],'id'=>$first['id']]]);
             $request->session()->save();
             echo "<script>alert('登录成功');location.href='/articles/index'</script>";
         }else{
             echo "<script>alert('登录失败，账号或密码有误');location.href='/logins/logins'</script>"; 
         }
         
     }

}
