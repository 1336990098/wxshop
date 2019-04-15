<?php
namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use App\Model\Wechat;
use Illuminate\Http\Request;

use CURLFile;


class MaterialController extends Controller
{
    /*
     * @content
     * @params
     * */
    public function index()
    {

        return view('wechat.index');
    }
    /*
     * @content
     * @params
     * */
    public function uploadFile(Request $request)
    {
        //接收文件
        if($request->hasFile('material')){

            //接收文件
            $file = $request->material;
            //上传文件
            $res = Wechat::UploadFile($file);
            $imgpath = $res['imgpath'];
            $data = $res['data'];

            //上传素材
            $token = Wechat::getAccessToken();
            $type = Wechat::getType($data);
            $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$token&type=$type";
            $data = ['media'=>new CURLFile(realpath($imgpath))];
            $re = Wechat::HttpsPost($url,$data);
            $result = json_decode($re,true);
            if(isset($result['errcode'])){
                die($result['errmsg']);
            }else{
                $mediaid=$result['media_id'];
                echo $mediaid;
            }
        }else{
            echo '文件不存在';die;
        }
    }

}