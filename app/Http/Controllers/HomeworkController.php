<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keeper;
use App\Goods_admin;
class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $res=Goods_admin::get();
        // dd($res);
        
        return view('homework.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       return view('homework.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
        $res=Keeper::where('id',$id)->delete();
        if($res){
             return redirect('/homework/user');
        }

        //
    }
    public function login(){
        return view('homework.login');
    }
    public function do_login(Request $request){
    $data=$request->except('_token');
    
        $data['upwd']=md5($data['upwd']);
        $user=Keeper::where($data)->first();
            
            //     session(['uname'=>$uname,'authority'=>$authority]);
            // $request->session()->save();
            if($user['authority']==2){
                 return redirect('/homework/index');
             }else{
                return redirect('/homework/create');
             }
          
        
             
        
    }
    public function user(){
        $user=Keeper::get();

        return view('homework.user',['user'=>$user]);
    }
    public function add(){
        return view('homework.add');
    }
    public function do_add(Request $request){
         $data=$request->except('_token');
         $data['upwd']=md5('upwd');
         $res=Keeper::insert($data);
          return redirect('/homework/user');
    }
}
