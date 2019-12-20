<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Index\User;
/**短信验证类 */
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
/**---------------------- */
class Login extends Controller
{
    /**用户登录视图 */
    function login()
    {
        return view('/index/login'); 
    }
    /**用户登录执行页面 */
    function loginDo()
    {
        //接收用户的账号密码
        $data = request()->except('_token');
        $where= [
            ['account','=',$data['account']],
            ['pwd','=',$data['pwd']],
        ];
        $user_model = new User;
        $userInfo =$user_model::where($where)->first()->toArray();
        //dd($userInfo);
        if($userInfo){
            session(['user'=>$userInfo]);
            request()->session()->save();
            echo "<script>alert('登录成功');location.href='/'</script>";
        }else{
            echo "<script>alert('登录失败,账号或密码错误');location.href='/reg'</script>";
        }
    }
    /**用户注册视图 */
    function reg()
    {
        return view('/index/reg'); 
    }
    /** 用户注册 */
    function reg_add()
    {
        //接收值
        $data = request()->except('_token');
        $user_model = new User;
        $user_model->account = $data['tel'];
        $user_model->pwd = $data['pwd'];
        $user_model->u_time = time();
        $user_model->save();
        $res = $user_model;
        if($res){
            echo "<script>alert('注册成功');location.href='/login'</script>";
        }else{
            echo "<script>alert('注册失败');location.href='/reg'</script>";
        }
               
    }
    //获取手机 调用发送验证码方法
    function code()
    {
        $code = rand(100000,999999);
        $tel  = request()->tel;
        
        $res =$this->SendSms($tel,$code);
        //$res = true;
        if($res){
            session(['tel'=>['tel'=>$tel,'code'=>$code]]);
            request()->session()->save();
            echo  1;die;
        }else{
            echo  2;die;
        }
    }
    /** 检测验证码 */
    function checkCode()
    {
        //接受值
        $tel = request()->tel;
        $code = request()->code;
        $s_tel =session('tel');
        if($tel==$s_tel['tel']&&$code==$s_tel['code']){
            echo 1;die;
        }else{
            echo 2;die;
        }
        echo 2;die;
    }
    /**发送短信方法 */
    public function SendSms($tel,$code)
    {
        AlibabaCloud::accessKeyClient('LTAI4Fnn3jhcVuY2D6TJKUkH', 'PVrZCI2iJF2UG82Zm1ZLkKYKppx0RW')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

            try {
                $result = AlibabaCloud::rpc()
                                    ->product('Dysmsapi')
                                    // ->scheme('https') // https | http
                                    ->version('2017-05-25')
                                    ->action('SendSms')
                                    ->method('POST')
                                    ->host('dysmsapi.aliyuncs.com')
                                    ->options([
                                                    'query' => [
                                                    'RegionId' => "cn-hangzhou",
                                                    'PhoneNumbers' => $tel,
                                                    'SignName' => "天谕豪情",
                                                    'TemplateCode' => "SMS_176525940",
                                                    'TemplateParam' => "{code:$code}",
                                                    ],
                                                ])
                                    ->request();
               // print_r($result->toArray());
            } catch (ClientException $e) {
                echo $e->getErrorMessage() . PHP_EOL;
                return false;
            } catch (ServerException $e) {
                echo $e->getErrorMessage() . PHP_EOL;
                return false;
            }
            
            return true;
    }
    /**测试session */
    function test(){
        $user=session('user');
        
        print_r($user['account']);die;
    }
}
