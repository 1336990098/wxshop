<?php
namespace App\Model;

use Illuminate\Support\Facades\Storage;
class Wechat
{
    /*
     * @content 封装一个post请求
     * */
    public static function HttpsPost($url,$post_datas)
    {
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        //设置post数据
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_datas);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        return $data;
    }
    /*
     * @content 获取要获取的天气的城市
     * @params $str_string 用户输入的信息
     *
     * */
    public static function getCityName($str)
    {
        //第一种方式 截取
        //$city=substr($str,0,strpos($str,'天气'));
        //第二种方式 通过数组获取
        $arr = explode('天气',$str);
        $city = $arr[0];
        return $city;
    }


    /*
     * @content 图灵机器人
     * @params $keywords 用户输入的含有城市名称的字符串
     *
     * */
    public static function tuling($keywords)
    {
        //调用图灵机器人 完成关键词回复
        $data = [
            'perception'=>[
                'inputText'=>[
                    'text'=>$keywords
                ]
            ],
            'userInfo'=>[
                'apiKey'=>env("TULING_APIKEY"),
                'userId'=>env("TULING_USERID")
            ]
        ];
        $post_data = json_encode($data);
        $tuling_url="http://openapi.tuling123.com/openapi/api/v2";
        $res = self::HttpsPost($tuling_url,$post_data);
        $msg = json_decode($res,true)['results'][0]['values']['text'];
        return $msg;
    }

    /*
     * 天气接口 
     * */

    public static function getCityWether($city)
    {
        $url = "http://api.k780.com/?app=weather.today&weaid=$city&appkey=41513&sign=d28aff2cad65031346f6528676db3b5e&format=json";
        $data = file_get_contents($url);
        $data = json_decode($data,true);
        $code = $data['success'];

        if($code==1){
            $result = $data['result'];
            $str = "今天是:".$result['days']."日".$result['week']."\r\n";
            $str .= "天气:".$result['weather']."\r\n";
            $str .= "最高气温:".$result['temp_high']."度\r\n";
            $str .= "最低气温:".$result['temp_low']."度\r\n";
            $str .= $result['wind'].$result['winp'];
        }else{
            $str = "抱歉超级赛亚人4";
        }


        return $str;
    }

    /*
     * @content 获取token
     *
     * */
    public static function getAccessToken()
    {
        /*
         * 读取文件
         * 判断内容有没有,有的话读取 没有的话生成
         * 判断值是不是在有效期内 是的话读取 不是的话刷新
         * */
        //定义文件路径
        $filepath = public_path()."/wechat/token.txt";
        //文件内容读取
        $fileinfo = file_get_contents($filepath);
        //判断
        if(!empty($fileinfo)){
            $data = json_decode($fileinfo,true);
            $expire = $data['expire'];
            if(time()>$expire){
                $token = self::createAccessToken();
                $time  = time()+7100;
                $arr   = [
                    "token"=>$token,
                    "expire"=>$time,
                ];
                $content = json_encode($arr,JSON_UNESCAPED_UNICODE);
                file_put_contents($filepath,$content);
            }else{
                $token = $data['token'];
            }
        }else{

            $token = self::createAccessToken();
            $time  = time()+7100;
            $arr   = [
                "token"=>$token,
                "expire"=>$time,
            ];
            $content = json_encode($arr,JSON_UNESCAPED_UNICODE);
            file_put_contents($filepath,$content);
        }

        return $token;
    }

    /*
     *@content 生成access_token
     * @params $appid string 微信的appid
     * @params $appsecret string 微信的appsecret
     * */
    public static function createAccessToken()
    {
        $appid = env("WXAPPID");
        $appsecret = env("WXAPPSECRET");
        $token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $res = file_get_contents($token_url);
        $token = json_decode($res,true)['access_token'];
        return $token;
    }

    /*
     * 
     * */
    public static function getType($str)
    {
        $arr = explode('/',$str);
        $ty = $arr[0];
        $allow_type = [
            'image'=>'image',
            'audio'=>'voice',
            'video'=>'video'
        ];

        return $allow_type[$ty];
    }
    /*
     * 上传文件
     * */
    public static function UploadFile($file)
    {
        //获取文件类型
        $data = $file->getClientMimeType();
        //获取文件的后缀名
        $ext = $file->getClientOriginalExtension();
        //获取临时文件的位置
        $path = $file->getRealPath();
        //生成新文件名
        $newfilename = date('Ymd')."/".mt_rand(1000,9999).".".$ext;
        //上传
        Storage::disk('uploads')->put($newfilename,file_get_contents($path));

        $imgpath = public_path().'/uploads/'.$newfilename;

        $data = ['data'=>$data,'imgpath'=>$imgpath];

        return $data;
    }
}

