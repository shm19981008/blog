<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use DB;
use App\Paper;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    
    public function add(){
    	return view('paper.add');
    }
    public function do_add(Request $request){
        //表单验证
        $request->validate([ 
        'title' => 'required|unique:paper|alpha_dash',
        ],[
        'title.required'=>'文章标题不能为空',
        'title.unique'=>'名字已存在',
        'title.alpha_dash'=>'文章标题中文数字字母下划线组成',
        ]);
    	$data=$request->except('_token');
    	// dd($data);
        //文件上传
        if($request->hasFile('file')){
            $data['file']=$this->uploads('file');
        }
        $data['add_time']=time();
        // dd($data);
        $res=Paper::insert($data);

        if($res){
            return redirect('/paper/list');
        }
    }
    public function list(){
       
       $title=request()->title??'';
        $type=request()->type??'';
        // echo $title;die;
       $where=[];
       if($title){
        $where[]=['title','like',"%$title%"];
       }
       // if($type){
       //  $where[]=['type','=',$type];
       // }
       // dump($where) ;die;
        $page=request()->page??1;
        $res=cache('res'.$page.'_'.$title);
        // dump($res);
        if(!$res){
       $paginate=config('app.paginate');
       $res=Paper::where($where)->paginate($paginate);
       cache(['res'.$page.'_'.$title=>$res],60*5);
   }
        //是ajax请求，即要实现ajax分页
        if(request()->ajax()){
            return view('paper.ajaxPage',['res'=>$res,'title'=>$title,'type'=>$type,'query'=>request()->all()]);
        }
        return view('paper.list',['res'=>$res,'title'=>$title,'type'=>$type,'query'=>request()->all()]);
    }
    public function edit($id){
         // echo $id;die;
        $res=Paper::where('id',$id)->first();
        return view('paper.edit',['res'=>$res]);
    }
    public function update(Request $request,$id){
        // echo $id;
       
        $data=$request->except('_token');
        //文件上传
        if($request->hasFile('file')){
            $data['file']=$this->uploads('file');
        }
        //dd($data);
        $res=Paper::where('id',$id)->update($data);
        if($res){
            return redirect('/paper/list');
        }
    }
    public function destroy($id){
       
        // echo $id;die;
        $res=Paper::where('id',$id)->delete();
         if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
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
