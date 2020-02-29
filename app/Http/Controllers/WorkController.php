<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class WorkController extends Controller
{
   
    public function add(){
    	return view('work.add');
    }
    public function add_do(Request $request){
    	$data=$request->except('_token');
    	$data['add_time']=time();
    	//dd($data);
    	$res=DB::table('people')->insert($data);
    	if($res){
    		return redirect('/list');
    	}
    }
    public function list(){
    	$data=DB::table('people')->select()->get();
    	// dd($data);
    	
    	return view('work.list',['data'=>$data]);
    }
    public function edit($id){
    	$user=DB::table('people')->where('id',$id)->first();
    	return view('work.edit',['user'=>$user]);
    }
    public function update(Request $request,$id){
    	// echo $id;
    	$data=$request->except('_token');
    	$data['add_time']=time();
    	//dd($data);
    	$res=DB::table('people')->where('id',$id)->update($data);
    	if($res!==false){
    		return redirect('/list');
    	}

    }
    public function delete($id){
    	$res=DB::table('people')->where('id',$id)->delete();
    	if($res){
    		return redirect('/list');
    	}
    }
   
    
   
}
