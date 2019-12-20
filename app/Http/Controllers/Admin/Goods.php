<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Brand as brand_model;
use App\Model\Admin\Category as cate_model;
use App\MOdel\Admin\Goods as goods_model;
use Illuminate\Support\Facades\Cache;
class Goods extends Controller
{
    /**商品展示 */
    public function index()
    {
        //查询商品表数据
        $goodsInfo = Cache::get('data');
        if(!$goodsInfo){
            $goodsInfo = DB::table('goods as g')
                                        ->join('category as c','g.cate_id','=','c.cate_id')
                                        ->join('brand as b','g.brand_id','=','b.brand_id')
                                        ->get();
                                        //dump($goodsInfo);die;
            foreach($goodsInfo as $k=>$v){
                $goodsInfo[$k]->goods_imgs = explode('|',$v->goods_imgs);
            }
            Cache::put(['data'=>$goodsInfo],60);
        }    
        return view('admin/goods/index',['goodsInfo'=>$goodsInfo]);
    }                                       

    /**商品添加视图 */
    public function create()
    {
        $brandInfo = brand_model::all();
        $cateInfo  = cate_model::all();
        $cateInfo =get_cate($cateInfo);
        return view('admin/goods/create',['brandInfo'=>$brandInfo,'cateInfo'=>$cateInfo]);
    }

    /**商品添加执行 */
    public function store(Request $request)
    {
        $goodsData = $request->except('_token');
        //单文件上传
        if($file = $request->file('goods_img')){;
            $img =upload($file);
            $img =  implode('|',$img); 
            $goodsData['goods_img']=$img;
        }else{
            echo "<script>alert('文件上传有误');location.href='/goods/create'</script>";
        }
        //多文件上传
        if($files = $request->file('goods_imgs')){;
            $imgs =upload($files);
            $imgs =  implode('|',$imgs);  
            $goodsData['goods_imgs']=$imgs;
        }else{
            echo "<script>alert('文件上传有误');location.href='/goods/create'</script>";
        }
        //入库
        $res = goods_model::create($goodsData);
        if($res){
            echo "<script>alert('成功');location.href='/goods/index'</script>";
        }else{
            echo "<script>alert('失败');location.href='/goods/create'</script>";
        }
        
    }

    /**商品详情页 */
    public function show($id)
    {
        //
    }

    /**商品修改form */
    public function edit($id)
    {
        $brandInfo = brand_model::all();
        $cateInfo  = cate_model::all();
        $cateInfo =get_cate($cateInfo);
        $goodsInfo= goods_model::find($id);
        
        $goodsInfo->goods_imgs= explode('|',$goodsInfo->goods_imgs);
        return view('admin/goods/edit',['brandInfo'=>$brandInfo,'cateInfo'=>$cateInfo,'goodsInfo'=>$goodsInfo]);
    }

    /**商品修改执行 */
    public function update(Request $request, $id)
    {
        $goodsData = $request->except('_token');
        //单文件上传
        if($file = $request->file('goods_img')){;
            $img =upload($file);
            $img =  implode('|',$img); 
            $goodsData['goods_img']=$img;
        }    
        //多文件上传
        if($files = $request->file('goods_imgs')){;
            $imgs =upload($files);
            $imgs =  implode('|',$imgs);  
            $goodsData['goods_imgs']=$imgs;
        } 
        //入库
        $res = goods_model::where('goods_id',$id)->update($goodsData);
        if($res){
            echo "<script>alert('成功');location.href='/goods/index'</script>";
        }else{
            echo "<script>alert('失败');location.href='/goods/edit/'.$id</script>";
        }
    }

    /**商品删除 */
    public function destroy($id)
    {
        $res = goods_model::destroy($id);
        if($res){
            echo "<script>alert('成功');location.href='/goods/index'</script>";
        }else{
            echo "<script>alert('失败');location.href='/goods/index'</script>";
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
