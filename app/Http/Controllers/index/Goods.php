<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MOdel\Admin\Goods as goods_model;
class Goods extends Controller
{
    function goods_list(){
        return view('/index/goods_list'); 
    }
    function prolist($id){
        $goodsInfo = goods_model::find($id);
        $goodsInfo['goods_imgs']=explode('|',$goodsInfo['goods_imgs']);
        //dd($goodsInfo);
        return view('/index/prolist',['goodsInfo'=>$goodsInfo]); 
    } 
}
