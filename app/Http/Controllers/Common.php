<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function checkGoodsNum($goods_id,$num,$buy_number){
        //根据id写条件
        $where=[
            'goods_id'=>$goods_id
        ];
        //查询
        $goods_num=Index::where($where)->lists('goods_num');
        //判断库存量是否在加入购物车的范围内
        if(($num+$buy_number)>$goods_num){
            $n=$goods_num-$num;
            $this->fail('您购买数量已超过库存，您还可以购买'.$n.'件');
        }
    }
}
