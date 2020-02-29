<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use DB;
use App\Student;
use Illuminate\Http\Request;
class StudentController extends Controller
{
    
    public function add(){
    	return view('student.add');
    }
    public function creat(Request $request){
        //表单验证
        $request->validate([ 
        'name' => 'required|unique:student|alpha_dash|between:2,12',
        'sex' => 'required|integer',
        'class' => 'required|max:10|min:2',
        'num' => 'required|lt:100|numeric',
        ],[
        'name.required'=>'名字不能为空',
        'name.unique'=>'名字已存在',
        'name.alpha_dash'=>'数字字母下划线组成',
        'name.between'=>'名字长度在2-12位之间',
        'sex.integer'=>'性别必须是数字类型',
        'class.required'=>'班级不能为空',
        'num.required'=>'成绩不能为空',
        'num.lt'=>'成绩不超过100分',
        'num.numeric'=>'成绩必须是数字类型',
        ]);
    	$data=$request->except('_token');
    	//dd($data);
        //文件上传
        if($request->hasFile('head')){
            $data['head']=$this->uploads('head');
        }
        // dd($data);
        $res=DB::table('student')->insert($data);

        if($res){
            return redirect('/list');
        }
    }
    public function list(){
       //  $res=DB::table('student')->select()->get();
       // dd($res);
       $name=request()->name??'';
        $class=request()->class??'';
       // echo $name;die;
       $where=[];
       if($name){
        $where[]=['name','like',"%$name%"];
       }
       if($class){
        $where[]=['class','=',$class];
       }
       $paginate=config('app.paginate');
       $res=Student::where($where)->paginate($paginate);
        return view('student.list',['res'=>$res,'name'=>$name,'class'=>$class]);
    }
    public function edit($id){
        // echo $id;
        $res=DB::table('student')->where('id',$id)->first();
        return view('student.edit',['res'=>$res]);
    }
    public function update(Request $request,$id){
        // echo $id;
        //表单验证
        $request->validate([ 
        'name' =>['regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
            Rule::unique('student')->ignore($id,'id')
    ],
        'sex' => 'required|integer',
        'class' => 'required|max:10|min:2',
        'num' => 'required|lt:100|numeric',
        ],[
        'name.required'=>'名字不能为空',
        'name.unique'=>'名字已存在',
        'name.alpha_dash'=>'数字字母下划线组成',
        'name.between'=>'名字长度在2-12位之间',
        'sex.integer'=>'性别必须是数字类型',
        'class.required'=>'班级不能为空',
        'num.required'=>'成绩不能为空',
        'num.lt'=>'成绩不超过100分',
        'num.numeric'=>'成绩必须是数字类型',
        ]);
        $data=$request->except('_token');
        //dd($data);
        $res=DB::table('student')->where('id',$id)->update($data);
        if($res){
            return redirect('/list');
        }
    }
    public function delete($id){
        // echo $id;
        $res=DB::table('student')->where('id',$id)->delete();
         if($res){
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
