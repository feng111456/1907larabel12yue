<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Admin;
use Illuminate\Support\Facades\Auth;
class Login extends Controller
{
    /** 登录视图页面*/
    function login()
    {
        return view('admin/login/login');
    }
    /**登录检测页面 */
    function LoginDo()
    {
        $request = request();
        $adminInfo =$request->except('_token');
        // $where = [
        //     'account'=>$adminInfo['account'],
        //     'pwd'=>$adminInfo['pwd']
        // ];
        // $first = Admin::where($where)->first();

        // if($first){
        //     session(['admin'=>['account'=>$first['account'],'id'=>$first['id']]]);
        //     $request->session()->save();
        //     echo "<script>alert('登录成功');location.href='/admin/index'</script>";
        // }else{
        //     echo "<script>alert('登录失败，账号或密码有误');location.href='/login/login'</script>"; 
        // }
        if (Auth::attempt($adminInfo)) {
            // 认证通过...
            session(['admin'=>['name'=>Auth::user(),'id'=>Auth::id()]]);
            $request->session()->save();
            echo "<script>alert('登录成功');location.href='/admin/index'</script>";
           // return redirect()->intended('dashboard');
        }else{
            echo "<script>alert('登录失败，账号或密码有误');location.href='/login/login'</script>";
        }
        
    }
}
