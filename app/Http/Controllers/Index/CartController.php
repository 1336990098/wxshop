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
                'cart_status'=>1
            ];
            $ins=Cart::insert($data);
        } else{
            //有 执行累加(修改)
            $updateInfo=[
                'buy_number'=>$arr['buy_number']+$buy_number,
                'cart_status'=>1
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
            'cart_status'=>1,
        ];
        $goodsInfo=Cart::join('goods','cart.goods_id','=','goods.goods_id')->where($where)->get();
//        print_r($goodsInfo);die;
        //最新商品
        $goods_new=Index::all()->take(4);
        // offset 设置从哪里开始，limit 设置想要查询多少条数据,skip 跳过几条，take取多少条数据
        // $goods_new = Index::where([])->orderBy('create_time','desc')->offset(0)->take(4)->get();
        return view('cart/cartlist',['cartInfo'=>$cartInfo,'goodsInfo'=>$goodsInfo,'goods_new'=>$goods_new]);
    }

    //改变购买数量
    public function changeNum(Request $request)
    {
        $goods_id=$request->goods_id;
        $buy_number=$request->buy_number;
        $cartWhere=[
            'user_id'=>session('user'),
            'goods_id'=>$goods_id
        ];
//        print_r($cartWhere);die;
        $cartDate=[
            'buy_number'=>$buy_number
        ];
        $res=Cart::where($cartWhere)->update($cartDate);
        if($res){
            $this->successly('修改成功');
        }else{
            $this->fail('修改失败');
        }
    }

    //删除
    public function del(Request $request)
    {
        $goods_id=$request->goods_id;
        $where=[
            'goods_id'=>$goods_id
        ];
        $res=Cart::where($where)->update(['cart_status'=>'2','buy_number'=>0]);
        if($res){
            $this->successly('删除成功');
        }else{
            $this->fail('删除失败');
        }

    }
    //皮山
    public function delall(Request $request)
    {
        $cart_id=$request->cart_id;
        $cart_id=rtrim($cart_id,',');
        $cart_id=explode(',',$cart_id);
//        print_r($cart_id);die;
        $res=Cart::whereIn('cart_id',$cart_id)->update(['cart_status'=>2,'buy_number'=>0]);
        if($res){
            $this->successly('删除成功');
        }else{
            $this->fail('删除失败');
        }
    }
}
