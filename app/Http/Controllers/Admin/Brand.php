<?php

namespace App\Http\Controllers\Admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Brand as brand_model;
use App\Http\Requests\CheckBrand;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;
class Brand extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand_name = request()->brand_name;
        $brand_url = request()->brand_url;
        $where = [];
        if(!empty($brand_name)){
            $where[] =['brand_name','like',"%$brand_name%"];
        }
        if(!empty($brand_url)){
            $where[] =['brand_url','like',"%$brand_url%"];
        }
        //获取分页页码
        $p = request()->page;
        $info = Cache::get('data_'.$p.'_'.$brand_name.'_'.$brand_url);
        if(!$info){
            $info = brand_model::where($where)->orderBy('brand_id','asc')->paginate(3); 
            Cache::put(['data_'.$p.'_'.$brand_name.'_'.$brand_url =>$info],30);  
        }
        $query = request()->all();

        return view('admin/brand/index',['info'=>$info,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/brand/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(CheckBrand $request)
    public function store(Request $request)
    {
        // $request->validate(
        //     [
        //         'brand_name' => 'required|unique:brand|max:25|min:2',
        //         'brand_url' => 'required',
        //     ],
        //     [
        //         'brand_name.required'=>'品牌名称必填',
        //         'brand_name.unique'=>'品牌已存在',
        //         'brand_name.max'=>'品牌名称最多：长度位25',
        //         'brand_name.min'=>'品牌名称最少：长度2',
        //         'brand_url.required'=>'品牌网址必填',
        //     ]
        // );
        $data  = request()->except('_token');
         //验证
        $validator = Validator::make($data, [
            'brand_name' => 'required|unique:brand|max:25|min:2',
            'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称必填',
                    'brand_name.unique'=>'品牌已存在',
                    'brand_name.max'=>'品牌名称最多：长度位25',
                    'brand_name.min'=>'品牌名称最少：长度2',
                    'brand_url.required'=>'品牌网址必填', 
        ]);
        if ($validator->fails()) {
            return redirect('brand/create')
            ->withErrors($validator)
           ->withInput();
        }
        if(request()->hasFile('brand_logo')){
            $img = $this->upload('brand_logo');
            $data['brand_logo']=$img;
        }else{
            echo "<script>alert('文件上传有误');location.href='/brand/create'</script>";die;
        }
        $res = brand_model::create($data);
        if($res){
            echo "<script>alert('成功');location.href='/brand/index'</script>";
        }else{
            echo "<script>alert('失败');location.href='/brand/create'</script>";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = brand_model::find($id);
        return view('admin/brand/edit',['info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(CheckBrand $request,$id)
    public function update(Request $request,$id)
    {
        $data  = request()->except('_token');
        //验证
        $validator = Validator::make($data, [
            //'brand_name' => 'required|unique:brand|max:25|min:2',
            'brand_name' => [
                'required',
                Rule::unique('brand')->ignore($id,'brand_id'),
                'max:25',
                'min:2',
        ],
            'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称必填',
                    'brand_name.unique'=>'品牌已存在',
                    'brand_name.max'=>'品牌名称最多：长度位25',
                    'brand_name.min'=>'品牌名称最少：长度2',
                    'brand_url.required'=>'品牌网址必填', 
        ]);
        if ($validator->fails()) {
            return redirect('brand/edit/'.$id)
            ->withErrors($validator)
           ->withInput();
        }
        if(request()->hasFile('brand_logo')){
            $img = $this->upload('brand_logo');
            $data['brand_logo']=$img;
        }
        $res = brand_model::where('brand_id',$id)->update($data);
        if($res!==false){
            echo "<script> alert('成功');location.href='/brand/index';</script>";
        }else{
            echo "<script> alert('失败');location.href='/brand/index/'.$id; </script>";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = brand_model::destroy($id);
        if($res){
            echo "<script> alert('成功');location.href='/brand/index';</script>";
        }else{
            echo "<script> alert('失败');location.href='/brand/index'; </script>";
        }
    }
    public function upload($img){
        if (request()->file($img)->isValid()) {
            $photo = request()->file($img);
            $store_result = $photo->store('img');
            //$store_result = $photo->storeAs('photo', 'test.jpg');
            return $store_result;
            }
    }
    public function checkName(){
        $brand_name = request()->brand_name;
        $count = brand_model::where('brand_name','=',$brand_name)->count();
        if($count>0){
            echo 1;
        }else{
            echo 2;
        }
    }
}
