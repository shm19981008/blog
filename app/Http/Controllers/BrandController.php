<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\StoreBlogPost;
use Validator;
class BrandController extends Controller
{
    public function index(){
    	echo 'hello';
    }
    public function add(){
    	return view('brand.add');
    }
    public function do_add(Request $request){
        //表单验证
        $request->validate([ 
        'bname' => 'required|unique:brand|max:30|min:3',
        'url' => 'required|unique:brand|max:10|min:3',
        ],[
        'bname.required'=>'名字不能为空',
        'bname.unique'=>'名字已存在',
        'bname.max'=>'名字长度不超过30位',
        'bname.min'=>'名字长度不小于3位',
        'url.required'=>'网址不能为空',
        'url.unique'=>'网址已存在',
        'url.max'=>'网址长度不超过10位',
        'url.min'=>'网址长度不小于3位',
        ]);
    	$data=$request->except('_token');
        // //表单提交
        // $validator = Validator::make($data,[
        //     'bname' => 'required|unique:brand|max:30|min:3',
        //      'url' => 'required|unique:brand|max:10|min:3',
        // ],[
        //     'bname.required'=>'名字不能为空',
        //     'bname.unique'=>'名字已存在',
        //     'bname.max'=>'名字长度不超过30位',
        //     'bname.min'=>'名字长度不小于3位',
        //     'url.required'=>'网址不能为空',
        //     'url.unique'=>'网址已存在',
        //     'url.max'=>'网址长度不超过10位',
        //     'url.min'=>'网址长度不小于3位',
        // ]);
        //  if ($validator->fails()) { 
        //     return redirect('/do_add')
        //     ->withErrors($validator)
        //     ->withInput();
        //   }
        //上传文件
        if($request->hasFile('logo')){
            $data['logo']=$this->uploads('logo');
        }


    	$res=Brand::insert($data);
        if($res){
            return redirect('/list');
        }
    }
    public function list(){
        //搜索
        $bname=request()->bname??'';
        $where=[];
        if($bname){
            $where[]=['bname','like',"%$bname%"];
        }
        $pagesize=config('app.paginate');
        $res=Brand::where($where)->orderby('id','desc')->paginate($pagesize);
        return view('brand.list',['res'=>$res,'bname'=>$bname]);
    }
    public function delete($id){
       $res=Brand::destroy($id);
       if($res){
         return redirect('/list');
       }
    }
    public function edit($id){
       $res=Brand::where('id',$id)->first();
       return view('brand.edit',['res'=>$res]);
    }
    public function update(Request $request,$id){
       $data=$request->except('_token');
       // dd($data);
       if($request->hasFile('logo')){
            $data['logo']=$this->uploads('logo');
        }
        $res=Brand::where('id',$id)->update($data);
        if($res!==false){
            return redirect('/list');
        }
    }
     public function uploads($filename){
        //判断上传有无错误
        if (request()->file($filename)->isValid()){
            //接收值
            $photo = request()->file($filename);
            //上传
            $store_result = $photo->store('uploads');
            return $store_result;
           }
        exit('未获取到上传文件或上传过程出错');
    }

   
}
