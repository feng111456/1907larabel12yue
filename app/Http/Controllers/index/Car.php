<?php

namespace App\Http\Controllers\index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Index\Cart as cart_model;
use App\MOdel\Admin\Goods as goods_model;
class Car extends Controller
{
    /**购物车展示 */
    function car()
    {
        //获取用户id
        $user_id = getUserId();
        if($user_id){
            $info = $this->getCartInfo($user_id);
            return view('/index/car',['info'=>$info]);
        }else{
            echo "<script>alert('非法操作')；location.href='/'</script>";
        }
        
    }
    //根据用户id查询购物车表与商品表数据
    function getCartInfo($user_id)
    {
        $where=[
            ['user_id','=',$user_id],
            ['cart_del','=',1]
        ];
        $info  = cart_model::leftjoin('goods as g','cart.goods_id','=','g.goods_id')
                ->select('cart.goods_id','goods_img','goods_name','buy_number','add_time','goods_num','goods_price')
                ->where($where)
                ->orderBy('add_time','desc')
                ->get();
        return $info;
    }
    //购物车添加执行
    function car_add()
    {
        $data = request()->except('_token');
       if(empty(session('user'))){
            echo json_encode(['font'=>'请先登录！！！','code'=>3]);die;
       }else{
            
            $user_id = getUserId();
            $data['user_id']=$user_id;
            $where= [
                ['goods_id','=',$data['goods_id']],
                ['user_id','=',$user_id],
                ['cart_del','=',1]
            ];
            $info =cart_model::where($where)->first();
            if($info){
                $res=cart_model::where($where)->update(['buy_number'=>$info['buy_number']+$data['buy_number'],'add_time'=>time()]);
                    if($res){
                        echo json_encode(['font'=>'添加成功','code'=>1]);
                    }else{
                        echo json_encode(['font'=>'添加失败','code'=>2]);
                    }
            }else{
                $data['add_time']=time();
                $res = cart_model::create($data);
                if($res){
                    echo json_encode(['font'=>'添加成功','code'=>1]);
                }else{
                    echo json_encode(['font'=>'添加失败','code'=>2]);
                }
            }    
       }
    }
    /** 购买数量改变*/
    function changeBuy_bumber()
    {
        $goods_id = request()->goods_id;
        $buy_number = request()->buy_number;
       //获取用户id
        $user_id = getUserId();
        $where=[
                ['user_id','=',$user_id],
                ['cart_del','=',1],
                ['goods_id','=',$goods_id]
            ];
        $res = cart_model::where($where)->update(['buy_number'=>$buy_number]);
        if($res!==false){
            echo 1;
        }else{
            echo 2;
        }
    }
    /** 获取小计 */
    function changePrice()
    {
        $goods_id = request()->goods_id;
        //获取商品单价
        $goods_price = goods_model::where('goods_id','=',$goods_id)->first('goods_price')->toArray();
        //获取用户id
        $user_id = getUserId();
        $where=[
                ['user_id','=',$user_id],
                ['cart_del','=',1],
                ['goods_id','=',$goods_id]
            ];
        //获取购买数量
        $buy_number = cart_model::where($where)->first('buy_number')->toArray();
        $price= $goods_price['goods_price']*$buy_number['buy_number'];
        echo $price;
        
    }
    /**获取总价 */
    function AllPrice()
    {
        $goods_id = request()->goods_id;
        $goods_id = explode(',',$goods_id);
        //获取用户id
        $user_id = getUserId();
        $where=[
                ['user_id','=',$user_id],
                ['cart_del','=',1],
            ];
        $allInfo =cart_model::join('goods as g','cart.goods_id','=','g.goods_id')
                            ->select('goods_price','buy_number')
                            ->where($where)
                            ->whereIn('g.goods_id',$goods_id)
                            ->get();
        $allPrice = 0;
        foreach($allInfo as $v){
            $allPrice +=($v->goods_price*$v->buy_number);
        }
        echo OK;die;
        echo $allPrice;
    }
    /**删除购物车数据 */
    function del()
    {
        //获取用户id
        $user_id = getUserId();
        $where=[
                ['user_id','=',$user_id],
                ['cart_del','=',1],
            ];
            $goods_id = request()->goods_id;
            $goods_id = explode(',',$goods_id);
        $res = cart_model::where($where)->whereIn('goods_id',$goods_id)->update(['cart_del'=>2]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

}
