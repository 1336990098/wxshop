<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Index;
class Common extends Controller
{
    /**
     * @param  错误提示信息
     */
    function fail($font){
        echo json_encode(['font'=>$font,'code'=>2]);exit;
    }

    /**
     * @param  正确提示信息
     */
    function successly($font){
        echo json_encode(['font'=>$font,'code'=>1]);exit;
    }
    /**
     * 无限极分类
     */
    function allCate($cate,$pid){
        static $arr=[];
        foreach($cate as $k=>$v){
            if($v['pid']==$pid){
                $arr=$v['cate_id'];
                $this->cate($v['cate_id']);
            }
        }
        return $arr;
    }
//

}
