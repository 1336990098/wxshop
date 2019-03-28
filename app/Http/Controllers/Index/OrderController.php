<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Index;
use App\Model\User;
use App\Model\Address;
use App\Model\Area;
use App\Http\Controllers\Common;
use Illuminate\Support\Facades\DB;
class OrderController extends Common
{
    /**结算页面*/
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

    /**接收id*/
    public function sid(Request $request)
    {
        $goods_id=$request->goods_id;
        $goods_id=rtrim($goods_id,',');
        session(['puy_id'=>$goods_id]);


    }

    /**收货地址*/
    public function address()
    {
        $user_id=session('user');
        $where=[
            'user_id'=>$user_id,
            'address_status'=>1
        ];
        $addressInfo=Address::where($where)->get();

        return view('order/address',['addressInfo'=>$addressInfo]);
    }

    /**展示顶级收货地址*/
    public function addressadd()
    {
        $area=Area::where('pid',0)->get();

        return view('order/addressadd',['area'=>$area]);
    }

    /**添加收货地址执行页面*/
    public function addressadddo(Request $request)
    {
        $data=$request->obj;
        $user_id=session('user');
        $data['user_id']=$user_id;
//         dump($data);die;
        if($data['is_default']==1){
            $where=[
                'user_id'=>session('user')
            ];
            DB::beginTransaction();//开启事务操作
            $result=Address::where($where)->update(['is_default'=>2,'address_status'=>1]);
            $res=Address::insert($data);
            if($result!==false&&$res){
                DB::commit();//事务提交
                $this->successly('添加成功');
            }else{
                DB::rollback();//回滚
                $this->fail('添加失败');
            }
        }else{
            $res=Address::insert($data);
            if($res){
                $this->successly('添加成功');
            }else{
                $this->fail('添加失败');
            }
        }
    }

    /**获取下一级地区*/
    public function getArea(Request $request)
    {
        $id=$request->id;
        if(empty($id)){
            $this->fail('请必须选择一项');
        }
        $where=[
          'pid'=>$id
        ];
        $data=Area::where($where)->get();
        echo json_encode(['data'=>$data,'code'=>1]);
    }

    /**删除地址*/
    public function addressdel(Request $request)
    {
        $address_id=$request->address_id;
        $where=[
            'address_id'=>$address_id
        ];
        $res=Address::where($where)->update(['address_status'=>2]);
        if($res){
            $this->successly('删除成功');
        }else{
            $this->fail('删除失败');
        }
    }

}
