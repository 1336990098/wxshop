<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Wechat;

class WechatController extends Controller
{
    /*
     * @content 微信绑定服务器校验
     * @params
     * */
    public function check(Request $request)
    {
//        $echostr = $request->echostr;
//        $signature = $request->signature;
//        $timestamp = $request->timestamp;
//        $nonce = $request->nonce;
//        if ($this->CheckSignature($signature,$timestamp,$nonce)){
//            echo $echostr;exit;
//        }
        //执行推送消息的方法
        $this->responseMsg();
    }

    /*
     * @content 推送消息
     *
     * */
    public function responseMsg()
    {

        $postStr = file_get_contents("php://input");
        $postObj = simplexml_load_string($postStr);
        $fromUsername = $postObj->FromUserName; //请求消息的用户
        $toUsername = $postObj->ToUserName; //"我"的公众号id
        $keywords = $postObj->Content;
        $time=time();//时间戳
        $msgtype = 'text'; //消息类型: 文本
        $textTpl = "<xml>
                      <ToUserName><![CDATA[%s]]></ToUserName>
                      <FromUserName><![CDATA[%s]]></FromUserName>
                      <CreateTime>%s</CreateTime>
                      <MsgType><![CDATA[%s]]></MsgType>
                      <Content><![CDATA[%s]]></Content>
                    </xml>";
        //首次关注回复消息
        if($postObj->MsgType == 'event'){
            if($postObj->Event == 'subscribe'){ //如果是订阅号
                //获取类型
//                $contentStr = "欢迎来到孙华展的订阅号,您将加入超级赛亚人的行列";
//                $resultStr=sprintf($textTpl,$fromUsername,$toUsername,$time,$msgtype,$contentStr);
//                echo $resultStr;
//                exit();
                $textTpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime><![CDATA[%s]]></CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>1</ArticleCount>
                          <Articles>
                            <item>
                              <Title><![CDATA[%s]]></Title>
                              <Description><![CDATA[%s]]></Description>
                              <PicUrl><![CDATA[%s]]></PicUrl>
                              <Url><![CDATA[%s]]></Url>
                            </item>
                          </Articles>
                        </xml>";
                $msgtype='news';
                $title = "诺坎普球场";
                $description = "煤球王";
                $picurl = "http://mmbiz.qpic.cn/mmbiz_jpg/0XMc36REHibBT3XQ4mAiaibbZgltGeibdaeSVopGGW7LmSQqNgDfGskT9DbrDXyEhSLcZOiasDaDoKNb4CphDtZp76Q/0?wx_fmt=jpeg";
                $url = "https://baijiahao.baidu.com/s?id=1618347432487379522&wfr=spider&for=pc";
                $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time,$msgtype,$title,$description,$picurl,$url);
                echo $resultStr;
                die;
            }
        }
        //关键词回复消息
        if($keywords == '你好'){
            $contentStr = '你好,超级赛亚人4';
            $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time,$msgtype,$contentStr);
            echo $resultStr;
            exit();
        } elseif($keywords == '图片'){
            $textTpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime><![CDATA[%s]]></CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                          </Image>
                        </xml>";
            $msgtype='image';
            $mediaid="ls-c1iO5Spz_OvFNXORgIKA9xZjp511NCGVhfzfP8Z-mbHudcFlr2r8fXRQJNkfP";
            $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time,$msgtype,$mediaid);
            echo $resultStr;
            die;
        } else if(strpos($keywords,"天气")){
            //获取城市名称
            $city = Wechat::getCityName($keywords);
            //获取城市代码
            $code=Wechat::getCityWether($city);

            $contentStr = $code;
            $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time,$msgtype,$contentStr);
            echo $resultStr;

        }else{
            $msg=Wechat::tuling($keywords);
            $contentStr = $msg;
            $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time,$msgtype,$contentStr);
            echo $resultStr;
        }
    }

    /*
     * @content 校验微信签名
     * */
    private function CheckSignature($signature,$timestamp,$nonce)
    {
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];

        $token =env("WEIXINTOKEN");
        $arr = array($token,$timestamp,$nonce);
        sort($arr);
        $arrstr = implode($arr);
        $str = sha1($arrstr);
        if($str == $signature){
            return true;
        }else{
            return false;
        }
    }
}
