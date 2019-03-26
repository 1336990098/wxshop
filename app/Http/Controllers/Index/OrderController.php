<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Index;
use App\Model\User;
use App\Model\Address;
class OrderController extends Controller
{
    //结算页面
    public function payment()
    {
        $user_id = session('user');
        $goods_id=session('puy_id');
        $goods_id=explode(',',$goods_id);
//        print_R($goods_id);die;
        $where=[
            'user_id'=>$user_id,
            'cart_status'=>1,
        ];
//        print_R($where);die;
        $puyInfo=Index::join('cart','goods.goods_id','=','cart.goods_id')
                ->where($where)
                ->whereIn('cart.goods_id',$goods_id)
                ->get();
        $price=0;
        foreach($puyInfo as $v){
            $price+=$v['buy_number']*$v['self_price'];
        }
//        echo $price;
        return view('order/payment',['puyInfo'=>$puyInfo,'price'=>$price]);
    }

    //接收id
    public function sid(Request $request)
    {
        $goods_id=$request->goods_id;
        $goods_id=rtrim($goods_id,',');
        session(['puy_id'=>$goods_id]);


    }

    //收货地址
    public function address()
    {
        $user_id=session('user');
        $addressInfo=Address::where('user_id',$user_id)->get();

        return view('order/address',['addressInfo'=>$addressInfo]);
    }

    //添加收货地址
    public function addressadd()
    {
        return view('order/addressadd');
    }
}
