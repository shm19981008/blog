<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Admin::get();
        return view('admin.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token','pwd2');
        // dd($data);
        //表单验证
        $request->validate([ 
        'account' => 'required|unique:admin',
        'pwd' => 'required',
        'email'=>'required',
        'tel'=>'required',
        ],[
        'account.required'=>'账号不能为空',
        'account.unique'=>'账号已存在',
        'pwd.required'=>'密码不能为空',
        'email.required'=>'邮箱不能为空',
        'tel.required'=>'手机号不能为空',
        
        ]);
        //文件上传
         if($request->hasFile('head')){
            $data['head']=uploads('head');
        }
        $data['pwd']=md5('pwd');
        $res=Admin::insert($data);
        if($res){
            return redirect('/admin/index');
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
        // echo $id;
        $data=Admin::where('admin_id',$id)->first();
        return view('admin.edit',['data'=>$data]);
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
        // dd($data);
        //文件上传
         if($request->hasFile('head')){
            $data['head']=uploads('head');
        }
        
        $res=Admin::where('admin_id',$id)->update($data);
        if($res){
            return redirect('/admin/index');
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
        // echo $id;
         $res=Admin::where('admin_id',$id)->delete();
         if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
}
