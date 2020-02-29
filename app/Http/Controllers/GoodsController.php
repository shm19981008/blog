<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Brand;
use App\Cate;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods_name=request()->goods_name??'';
        $brand_id=request()->brand_id;
        $where=[];
        if($goods_name){
            $where[]=['goods_name','like',"%$goods_name%"];
        }
        if($brand_id){
            $where[]=['brand_id','=',$brand_id];
        }
        $BrandInfo=Brand::get();
        $page=request()->page??1;
        // $data=cache('goods_'.$page);
        $data=Redis::get('goods_'.$page);
        dump($data);
        if(!$data){
        $pagesize=config('app.paginate');
        $data=Goods::leftJoin('brand', 'brand.id', '=', 'goods.brand_id')->where($where)->leftJoin('cate', 'cate.cate_id', '=', 'goods.cate_id')->paginate($pagesize);
        //存入缓存
        // cache(['goods_'.$page=>$data],60*60*24*30);
        $data=serialize($data);
        Redis::setex('goods_'.$page,20,$data);
        }
        $data=unserialize($data);
        return view('goods.index',['data'=>$data,'brandinfo'=>$BrandInfo,'goods_name'=>$goods_name,'brand_id'=>$brand_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $BrandInfo=Brand::get();
        $cateinfo=Cate::get();
         $info=getcateinfo($cateinfo);
        return view('goods.create',['brandinfo'=>$BrandInfo,'info'=>$info]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
         //表单验证
        $request->validate([ 
        'goods_name' => 'required|unique:goods',
        'goods_price' => 'required',
        ],[
        'goods_name.required'=>'商品名称不能为空',
        'goods_name.unique'=>'名字已存在',
        'goods_price.required'=>'商品价格不能为空',
        ]);
        if($request->hasFile('goods_img')){
            $data['goods_img']=uploads('goods_img');
        }
        //多文件上传
        if(isset($data['goods_imgs'])){
            $photos=Moreuploads('goods_imgs');
            $data['goods_imgs']=implode('|',$photos);
        }
        $data['goods_sn']=$this->CreatGoodsSn();
        //dd($data);
        $res=Goods::insert($data);
        if($res){
            return redirect('/goods/index');
        }
    }
    //商品货号
    public function CreatGoodsSn(){
        return 'goods'.date('YmdHis').rand(1000,9999);
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
        $data=Goods::where('goods_id',$id)->first();
        $BrandInfo=Brand::get();
        $cateinfo=Cate::get();
         $info=getcateinfo($cateinfo);
        return view('goods.edit',['data'=>$data,'brandinfo'=>$BrandInfo,'info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $data=$request->except('_token');
        //  //表单验证
        // $request->validate([ 
        // 'goods_name' => 'required|unique:goods',
        // 'goods_price' => 'required',
        // ],[
        // 'goods_name.required'=>'商品名称不能为空',
        // 'goods_name.unique'=>'名字已存在',
        // 'goods_price.required'=>'商品价格不能为空',
        // ]);
        if($request->hasFile('goods_img')){
            $data['goods_img']=uploads('goods_img');
        }
        //多文件上传
        if($data['goods_imgs']){
            $photos=Moreuploads('goods_imgs');
            $data['goods_imgs']=implode('|',$photos);
        }
        $data['goods_sn']=$this->CreatGoodsSn();
        //dd($data);
        $res=Goods::where('goods_id',$id)->update($data);
        if($res){
            return redirect('/goods/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del($id)
    {
        $res=Goods::where('goods_id',$id)->delete();
        if($res){
            return redirect('/goods/index');
        }
    }
}
