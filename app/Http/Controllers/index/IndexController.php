<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
use Illuminate\Support\Facades\Redis;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
class IndexController extends Controller
{
    public function index(){
      $page=request()->page??1;
      $goodsinfo=cache('goods_'.$page);
        dump($goodsinfo);
        if(!$goodsinfo){
   		$goodsinfo=Goods::paginate(5);
      cache(['goods_'.$page=>$goodsinfo],60*60*24*30);
      }
      
    	return view('index.index',['goodsinfo'=>$goodsinfo]);
 }
  
    public function protect($id){
    	// echo $id;
      
       $goodsinfo=cache('goods_'); 
      
       // dump($goodsinfo);
       //访问量
       $count=Redis::setnx('num'.$id,1);
       if(!$count){
        $count=Redis::incr('num'.$id);
       }
      if(!$goodsinfo){
    	$goodsinfo=Goods::where('goods_id',$id)->first();
       // dump($goodsinfo);die;
      
      cache('goods_',"$goodsinfo",60*60*24*30);
      
      } 
        return view('index.protect',['goodsinfo'=>$goodsinfo,'count'=>$count]);
    }
    public function add_cart(Request $request){
       $buy_num=$request->buy_num;
       $goods_id=$request->goods_id;
       // echo $buy_num;
       // echo $goods_id;die;
      $data=[
        'buy_num'=>$buy_num,
        'goods_id'=>$goods_id,
        'add_time'=>time(),

      ];

       $res=Cart::create($data);
       if($res){
        echo "ok";
       }else{
        echo "no";
       }

    }
    public function cart(){
     
      $res=Cart::select('goods.goods_id','goods_img','goods_name','goods_price','buy_num','add_time')
      ->leftjoin('goods','goods.goods_id','=','cart.goods_id')
      ->orderby('add_time','desc')
      ->get();
      return view('index.cart',['res'=>$res]);
    }
    public function pay(){
      return view('index.pay');
    }
  
}
