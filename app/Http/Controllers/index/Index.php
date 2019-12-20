<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category as cate_model;
use App\MOdel\Admin\Goods as goods_model;
class Index extends Controller
{
    function Index()
    {
        $cateInfo = cate_model::where('parent_id','=',0)->get();
        $cateId = 1;
        $goodsInfo =$this->getCateInfo($cateId);
        //dd($goodsInfo);
        //根据id查询所有商品表的数据
        
        return view('index/index',['cateInfo'=>$cateInfo,'goodsInfo'=>$goodsInfo]);
    }
    //查询数据
    function getCateInfo($cateId)
    {
        $cate_data = cate_model::get()  ;
        $cateId = getCataId($cate_data,$cateId);
        //print_r($cateId);die;
        $goodsInfo = goods_model::whereIn('cate_id',$cateId)->limit(6)->get();
        return $goodsInfo;
        
    }
    //数据替换
    function changeValue(){
        $cateId = request()->cate_id;
        $goodsInfo =$this->getCateInfo($cateId);
        return view('index/change',['goodsInfo'=>$goodsInfo]);
    }
        
}
