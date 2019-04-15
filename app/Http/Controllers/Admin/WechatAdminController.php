<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Wechat;
use App\Model\Subscribe;
use CURLFile;

class WechatAdminController extends Controller
{
    /*
     * @content 我的首页
     * */
    public function welcome()
    {

        return view('admin/welcome');
    }
    /*
     * @content 后台首页
     * */
    public function index()
    {

        return view('/admin/index');
    }
    /*
     * @content 上传表单
     * @params request mixed
     * */
    public function upform()
    {

        return view('/admin/upform');
    }
    /*
     * @content 上传执行
     * @params request mixed
     * */
    public function upformdo(Request $request)
    {
        if($request->hasFile('filename')){
            //接收文件
            $file = $request->filename;
            //上传文件
            $res = Wechat::UploadFile($file);
            $imgpath = $res['imgpath'];
            $data = $res['data'];
            //上传素材
            $token = Wechat::getAccessToken();
//            dd($token);
            $type = Wechat::getType($data);
            $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$token&type=$type";
//            dd($url);
            $data = ['media'=>new CURLFile(realpath($imgpath))];
            $res = Wechat::HttpsPost($url,$data);
            $data = json_decode($res,true);
            $arr = [
                'media_id'=>isset($data['media_id'])?$data['media_id']:null,
                'picurl'=>isset($data['url'])?$data['url']:null,
                'url'=>$request->input('url',NULL),
                'des'=>$request->input('des',NULL),
                'title'=>$request->input('title',NULL),
                'text'=>$request->input('text',NULL)
                ,'type'=>$request->input('type')
            ];
            $re = Subscribe::insert($arr);
            if($re){
                return view('admin/wxtype');
            }
        }

    }
    /*
     * @content 类型回复
     * */
    public function wxtype()
    {
        $data = config('wxconfig.subscribe');
        return view('admin.wxtype',['type'=>$data]);
    }
    /*
     * @content 类型确认
     * request
     * */
    public function wxtypedo(Request $request)
    {
        $type = $request->type;
        $path = config_path('wxconfig.php');
        $config = [];
        $config['subscribe'] = $type;
        $str = '<?php return '.var_export($config,true)."; ?>";
        file_put_contents($path,$str);
        return $type;

    }
    //测试
    public function test(Request $request)
    {

        Wechat::createAccessToken();
    }


}
