<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use DB;
use App\Cate;
use Illuminate\Http\Request;

class CateController extends Controller
{
    
    public function add(){
        $cateinfo=Cate::get();
        // dd($cateinfo);
        $info=getcateinfo($cateinfo);
        // dd($info);
        return view('cate.add',['info'=>$info]);
    }
    public function do_add(Request $request){
        //表单验证
        // $request->validate([ 
        // 'title' => 'required|unique:paper|alpha_dash',
        // ],[
        // 'title.required'=>'文章标题不能为空',
        // 'title.unique'=>'名字已存在',
        // 'title.alpha_dash'=>'文章标题中文数字字母下划线组成',
        // ]);
        $data=$request->except('_token');
         // dd($data);
        
        $res=Cate::insert($data);

        if($res){
            return redirect('/cate/list');
        }
    }
    public function list(){

       $paginate=config('app.paginate');
       $res=Cate::paginate($paginate);
       // dd($res);
        return view('cate.list',['res'=>$res]);
    }
    public function edit($id){
         // echo $id;die;
         $cateinfo=Cate::get();
        $info=getcateinfo($cateinfo);
        $res=Cate::where('cate_id',$id)->first();
        return view('cate.edit',['res'=>$res,'info'=>$info]);

    }
    public function update(Request $request,$id){
        // echo $id;
       
        $data=$request->except('_token');
        
        //dd($data);
        $res=Cate::where('cate_id',$id)->update($data);
        if($res){
            return redirect('/cate/list');
        }
    }
    public function del($id){
       
        // echo $id;die;
        $res=Cate::where('cate_id',$id)->delete();
         if($res){
            return redirect('/cate/list');
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
    public function checkonly(){
        $val=request()->val;
        $where=[];
        if($val){
            $where[]=['title','=',$val];
        }
         //排除自身
        $id=request()->id;
        echo $id;die;
        if($id){
            $where[]=['id','!=',$id];
        }
        $count=Paper::where($where)->count();
       

        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }
    
   
}
