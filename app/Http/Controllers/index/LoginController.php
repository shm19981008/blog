<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    public function do_login(Request $request){
    	$data=$request->except('_token');
    	$data['pwd']=md5($data['pwd']);
    	$user=Admin::where($data)->first();
    	// dd($user);
    	if($user){
    		// session(['user'=>$user]);
    		// $request->session()->save();
    		return redirect('/shop/index');
    	}
    	
    }
    public function do_register(Request $request){
    	$data=$request->except('_token');
      // dd($data);
      //判断验证码
      $code=session('code');
      // echo $code;die;
      if($code!=$data['code']){
        return redirect('/shop/register')->with('msg','您输入的验证码不正确，请再次输入');
      }
      //密码与确认密码一致
      if($data['pwd']!=$data['repwd']){
         return redirect('/shop/register')->with('msg','密码与确认密码不一致，请再次输入');
      }
      //入库
      $user=[
        'mobile'=>$data['mobile'],
        'pwd'=>encrypt($data['pwd']),
        'add_time'=>time(),
      ];
      $res=Admin::insert($user);
      if($res){
         return redirect('/shop/login');
      }
    }
    public function sendEmail(){
      $email='2863312004@qq.com';
      Mail::to($email)->send(new SendCode());
    }
      public function ajaxsend(){
    	//接受注册页面的手机号
    	//$moblie = '15832228731';
    	 $mobile = request()->mobile;
       
    	$code = rand(10000,99999);
    	$res = $this->sendSms($mobile,$code);
    	if( $res['Code']=='OK'){
    		session(['code'=>$code]);
    		request()->session()->save();

    		echo "发送成功";
    	}

    }

    public function sendSms($mobile,$code){

		AlibabaCloud::accessKeyClient('LTAI4FnrqLzzNFXpETnbMD8D', 'KxZdO7whSnqHkDrQZcITt2J5B2V2MZ')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

    try {
    $result = AlibabaCloud::rpc()
                          ->product('Dysmsapi')
                          // ->scheme('https') // https | http
                          ->version('2017-05-25')
                          ->action('SendSms')
                          ->method('POST')
                          ->host('dysmsapi.aliyuncs.com')
                          ->options([
                                        'query' => [
                                          'RegionId' => "cn-hangzhou",
                                          'PhoneNumbers' => $mobile,
                                          'SignName' => "shihuimin",
                                          'TemplateCode' => "SMS_181195372",
                                          'TemplateParam' => "{code:$code}",
                                        ],
                                    ])
                          ->request();
     return $result->toArray();
} catch (ClientException $e) {
    return $e->getErrorMessage();
} catch (ServerException $e) {
    return $e->getErrorMessage();
}

    }
}
