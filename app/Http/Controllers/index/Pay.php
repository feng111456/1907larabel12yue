<?php

namespace App\Http\Controllers\index;
use App\Model\Index\Area;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Index\Address as address_model;
use App\Model\Index\Cart as cart_model;
use App\Model\Index\Order;
use Illuminate\Support\Facades\DB;
use App\Model\Index\Order_address;
class Pay extends Controller
{
    /**订单提交视图 */
    function pay(){
        //获取用户id
        $user_id = getUserId();
        //接受id值
        $goods_id = explode(',',request()->goods_id);
        $where = [
            ['user_id','=',$user_id],
            ['cart_del','=',1]
        ];
        $cartInfo = cart_model::join('goods as g','cart.goods_id','=','g.goods_id')
                        ->select('g.goods_id','goods_name','goods_price','goods_img','buy_number','add_time') 
                        ->where($where)
                        ->whereIn('g.goods_id',$goods_id)
                        ->get()->toArray();
        //获取总价
        $Allprice = 0;
            foreach($cartInfo as $v){
                $Allprice+=$v['goods_price']*$v['buy_number'];
            }   
        $data['user_id']=$user_id;
        $where = [
            ['user_id','=',$user_id],
            ['address_del','=',1]
        ];
        $address_model = new address_model; 
        /**获取地址信息 */
        $addInfo = $address_model::where($where)->get()->toArray();
        foreach($addInfo as $k=>$v){
            $addInfo[$k]['province']=Area::where('id','=',$v['province'])->value('name');
            $addInfo[$k]['city']=Area::where('id','=',$v['city'])->value('name');
            $addInfo[$k]['area']=Area::where('id','=',$v['area'])->value('name');
        }

        return view('index/pay',['addInfo'=>$addInfo,'Allprice'=>$Allprice,'cartInfo'=>$cartInfo]);
    }
    /**订单提交 */
    function subOrder()
    {
        //接收值
        $goods_id = explode(',',request()->goods_id);
        $address_id = request()->address_id;
        $pay_method = request()->pay_method;
        //获取用户id
        $user_id = getUserId();
        //开启事务
        DB::beginTransaction();
            try{
                if(empty($goods_id)){
                    throw new \Exception('非法操作');
                }
                //实例化购物车model
                $cart_model = new cart_model;
                $cartInfo = $cart_model::join('goods as g','cart.goods_id','=','g.goods_id')
                            ->where([['user_id','=',$user_id],['cart_del','=',1]])->whereIn('g.goods_id',$goods_id)
                            ->get()->toArray();
                if(empty($cartInfo)){
                    throw new \Exception('非法操作');
                }
                $Allprice = 0;
                foreach($cartInfo as $v){
                    $Allprice+=$v['goods_price']*$v['buy_number'];
                }
                $orderInfo=[];
                $orderInfo['order_number'] = time().rand(10000,99999);
                $orderInfo['user_id']=$user_id;
                
                $orderInfo['order_price'] = $Allprice;
                
                $orderInfo['pay_type']  = $pay_method;
                
                $orderInfo['ctime']= time();
                //dd($orderInfo);
                //实例化订单表model
                $order_id = Order::insertGetId($orderInfo);  
                if(!$order_id>0){
                    throw new \Exception('订单提交有误');
                    //回滚
                    $order_model->rollback();
                    
                }
                /**提交事务 */
                DB::commit();
                //-------订单送货地址添加--------------
                $address_model = new address_model;
                $addressInfo = $address_model::where('address_id','=',$address_id)->first()->toArray();
                $addressInfo['order_id'] = $order_id;
                $addressInfo['user_id']  = $user_id;
                $addressInfo['ctime']  = time();
                unset($addressInfo['address_id']);
                unset($addressInfo['mail']);
                unset($addressInfo['address_del']);
                unset($addressInfo['is_status']);
                $order_address = Order_address::create($addressInfo);
                if(empty($order_address)){
                    throw new \Exception('订单送货地址添加有误');
                    //回滚
                    $order_model->rollback();
                }
                /**提交事务 */
                DB::commit();
                
                echo 1;

            }catch(\Exception $e){
                echo $e->getMessage();
            }
       
    }
    function pay_test()
    {
        return view('index/test');
    }
    function order()
    {
        $order_model = new Order;
        $order_id =request()->order_id;
        $orderInfo = $order_model::where('order_id','=',$order_id)->first();
        $this->payPrice($orderInfo->order_number,$orderInfo->order_price);
    }
    function payPrice($order_number,$order_prcie)
    {
        require_once app_path('lib/alipay/wappay/service/AlipayTradeService.php');
        require_once app_path('lib/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php');
        $config = config('alipay');
        if (!empty($order_number)&& trim($order_number)!=""){
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $order_number;

            //订单名称，必填
            $subject = '攀峰';

            //付款金额，必填
            $total_amount =$order_prcie;

            //商品描述，可空
            $body = '';

            //超时时间
            $timeout_express="1m";

            $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new \AlipayTradeService($config);
            $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

            return ;
        }
    }
}
