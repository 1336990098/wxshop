<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LoginModel;
use App\Model\User;

class Login extends Controller
{
    //登录
    public function login()
    {
        return view('login/login');
    }
    //登录执行
    public function logindo(Request $request)
    {
        $data=$request->all();
        $str=$data['user_pwd'];
//        echo $str;die;
        unset($data['_token']);
//        echo session('verifycode');die;
        if($data['user_code']!=session('verifycode')){
            echo 0;//验证码错误
        }else{
            $arr=User::where('user_tel',$data['user_tel'])->first();
//            print_r($arr);die;
//            echo $arr['user_pwd'];
            if(empty($arr)){
                echo 1;//没有账号
            }else if(decrypt($arr['user_pwd'])!=$str){
                echo 2;//密码不对
            }else{
                session(['user'=>$arr['user_id']]);;//登陆成功 将user_id存入session
//                echo $user_id=session('user');die;
                echo 3;//登陆成功
            }
        }

    }
    //注册
    public function register(Request $request)
    {
        return view('login/register');
    }

    //注册执行
    public function registerdo(Request $request)
    {
        $tel = $request->tel;
        $checktel = User::where('user_tel', $tel)->first();
        if (!empty($checktel)) {
            echo '2'; //存在
            die;
        } else {
            $data = $request->all();
//        print_R($data);die;
            $pwd2 = $data['pwd2'];
            $user_pwd = $data['user_pwd'];
            unset($data['_token']);
            unset($data['pwd2']);
            $data['user_pwd'] = encrypt($data['user_pwd']);
            $code = session('mobilecode');

            if ($data['user_code'] != $code) {
                echo 4;//验证码错误
            } else if ($pwd2 != $user_pwd) {
                echo 5;//两次密码不对
            } else {
//                $res=LoginModel::insert($data);
                $user_id = LoginModel::insertGetId($data);
//                echo $res;die;
                if (!empty($user_id)) {
                    session(['user' => $user_id]);
                    echo 1;//注册成功
                } else {
                    echo 8;//注册失败
                }
            }
        }

    }

    //传手机号
    public function sendcode(Request $request){
//        echo 1;die;
        $mobile=$request->u_name;
        $this->sendMobile($mobile);
    }

    //获取取验证码
    public static function createcode($len)
    {
        $code = '';
        for($i=1;$i<=$len;$i++){
            $code .=mt_rand(0,9);
        }

        return $code;
    }

    /*
     * @content 发送手机验证码
     * @params  $mobile  要发送的手机号
     *
     * */
//    private function sendMobile($mobile)
//    {
//        $host = env("MOBILE_HOST");
//        $path = env("MOBILE_PATH");
//        $method = "POST";
//        $appcode = env("MOBILE_APPCODE");
//        $headers = array();
//        $code = $this->createcode(4);
//        session(['mobilecode'=>$code]);
//        array_push($headers, "Authorization:APPCODE " . $appcode);
//        $querys = "content=【创信】你的验证码是："."$code"."，3分钟内有效！&mobile=".$mobile;
//        $bodys = "";
//        $url = $host . $path . "?" . $querys;
//
//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
//        curl_setopt($curl, CURLOPT_URL, $url);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//        curl_setopt($curl, CURLOPT_FAILONERROR, false);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($curl, CURLOPT_HEADER, true);
//        if (1 == strpos("$".$host, "https://"))
//        {
//            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//        }
//        return curl_exec($curl);
//    }


}
