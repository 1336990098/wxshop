<?php

namespace App\Http\Controllers\Index;

use App\Model\Cart;
use App\Model\Index;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use think\response\Redirect;
use App\Http\Controllers\Common;


class CartController extends Common
{
    //加入购物车
    public function cart(Request $request)
    {
        //判断是否登录
        $user_id = session('user');

        if(empty($user_id)){
            //未登录
            echo 7;die;
        }
        $goods_id=$request->goods_id;
        $goods_num=$request->goods_num;
        $buy_number=$request->buy_number;
        $where=[
          'user_id'=>$user_id,
          'goods_id'=>$goods_id,
        ];
        //判断商品是否已经添加过
        $arr=Cart::where($where)->first();
        if(empty($arr)){
            //没有数据 执行添加
            $data=[
                'user_id'=>$user_id,
                'goods_id'=>$goods_id,
                'buy_number'=>$arr['buy_number']+$buy_number,
            ];
            $ins=Cart::insert($data);
        } else{
            //有 执行累加(修改)

            $updateInfo=[
                'buy_number'=>$arr['buy_number']+$buy_number
            ];
            $add=Cart::where($where)->update($updateInfo);
        }
    }

    //购物车列表
    public function cartlist(Request $request)
    {
        //判断是否登录
        $user_id = session('user');
//        dump($userInfo);die;
        if(empty($user_id)){
            return redirect('login/login'); //跳转到登录
        }
        $cartInfo=Cart::where('user_id',$user_id)->get();
        $where=[
            'user_id'=>$user_id,
        ];
        $goodsInfo=Cart::join('goods','cart.goods_id','=','goods.goods_id')->where($where)->get();
//        print_r($goodsInfo);
        return view('cart/cartlist',['cartInfo'=>$cartInfo,'goodsInfo'=>$goodsInfo]);
    }

    //改变购买数量
    public function changeNum(Request $request)
    {

        $goods_id=$request->goods_id;
        $buy_number=$request->buy_number;
        $this->checkGoodsNum($goods_id,0,$buy_number);//检测库存
        $cart_model=model('Cart');
        $cartWhere=[
            'user_id'=>session('userInfo.user_id'),
            'goods_id'=>$goods_id
        ];
        $cartDate=[
            'buy_number'=>$buy_number
        ];
        $res=$cart_model->save($cartDate,$cartWhere);
        if($res){
            successly('修改成功');
        }else{
            fail('修改失败');
        }
    }
}
