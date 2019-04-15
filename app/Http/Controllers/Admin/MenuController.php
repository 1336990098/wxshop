<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Wechat;


class MenuController extends Controller
{
    /*
     * @content 获取自定义菜单
     * */
    public function getMenuList()
    {
        $token = Wechat::getAccessToken();
        $menu_url="https://api.weixin.qq.com/cgi-bin/menu/get?access_token=$token";
        dd($menu_url);
        $res = '{"menu":{"button":[{"type":"click","name":"今日歌曲","key":"V1001_TODAY_MUSIC","sub_button":[]},{"name":"菜单","sub_button":[{"type":"view","name":"搜索","url":"http:\/\/www.soso.com\/","sub_button":[]},{"type":"miniprogram","name":"wxa","url":"http:\/\/mp.weixin.qq.com","sub_button":[],"appid":"wx286b93c14bbf93aa","pagepath":"pages\/lunar\/index"},{"type":"click","name":"赞一下我们","key":"V1001_GOOD","sub_button":[]}]}]}}';
        $data=json_decode($res,true)['menu']['button'];

        $arr = [];
        $arr1 = [];
        foreach($data as $key=>$value){
            $arr[$key]['pid']=4;
            $arr[$key]['name']=$value['name'];
            $arr[$key]['type']=isset($value['type'])?$value['type']:null;
            $arr[$key]['url']=isset($value['url'])?$value['url']:null;
            $arr[$key]['key']=isset($value['kry'])?$value['kry']:null;
            if(!empty($value['sub_button'])){
                foreach($value['sub_button'] as $k=>$v){
                    $arr1[$k]['pid']=$key;
                    $arr1[$k]['name']=$v['name'];
                    $arr1[$k]['type']=isset($v['type'])?$v['type']:null;
                    $arr1[$k]['url']=isset($v['url'])?$v['url']:null;
                    $arr1[$k]['key']=isset($v['kry'])?$v['kry']:null;
                }
            }

        }
        print_R($arr);
        print_R($arr1);

    }
}