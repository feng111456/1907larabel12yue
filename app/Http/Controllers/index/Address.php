<?php

namespace App\Http\Controllers\index;
use App\Model\Index\Area;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Index\Address as address_model;
use App\Model\Index\Cart as cart_model;

class Address extends Controller
{
    function add_show(){
        $area_model = new Area;
        $pid = 0;
        $areaInfo= $this->getSiteInfo($pid);
        

        return view('index/address',['areaInfo'=>$areaInfo]);
    }
    function add(){
        $data = request()->except('_token');
        //获取用户id
        $user_id = getUserId();
        $data['user_id']=$user_id;
        $where = [
            ['user_id','=',$user_id],
            ['address_del','=',1]
        ];
        $address_model = new address_model;
        if($data['is_status']==1){
            $address_model::where($where)->update(['is_status'=>2]);    
        }     
        $res=$address_model::create($data);
        if($res){
            echo "<script>alert('成功');location.href='/pay'</script>";
        }else{
            echo "<script>alert('失败');location.href='/address'</script>";
        }
    }
    function getAddress(){
        $pid = request()->_id;
        $areaInfo= $this->getSiteInfo($pid);
        echo json_encode($areaInfo);
    }
     //查询子类地址的方法
     public function getSiteInfo($pid)
     {
         //实例化 地址model
         $area_model = new Area;
         $areaInfo =$area_model::where('pid','=',$pid)->get();
         return $areaInfo;
     }
}
