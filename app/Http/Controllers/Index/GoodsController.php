<?php

namespace App\Http\Controllers\Index;

use App\Model\Category;
use App\Model\Index;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class GoodsController extends Controller
{
    /*
     * @content 商品列表
     * @params $goodsInfo全部商品数据 $cateInfo顶级分类
     */
    public function goodslist(Request $request)
    {
        $cate_id=$request->cate_id;
        $goodsInfo=Index::get();
        $cateInfo=Category::where(['pid'=>0])->get();
        // dd($category);exit;
        return view('goods/goodslist',['goodsInfo'=>$goodsInfo,'cateInfo'=>$cateInfo]);
    }

    /*
     * @content 分类展示数据
     * @params $request  $id
     */
    public function category(Request $request)
    {
        $id=$request->input('id');
        if(empty($id)){
            $cate_id=Category::pluck('cate_id');
        }else{
            $cate_id=Category::where('pid','=',$id)->pluck('cate_id');
        }
        $c_id=Category::whereIn('pid',$cate_id)->pluck('cate_id');
        $cateInfo=Category::where(['pid'=>0])->get();
        $goods=Index::whereIn('cate_id',$c_id)->get();
        return view('goods/div',['goods'=>$goods,'cateInfo'=>$cateInfo]);
    }



    /*
     *@content 商品详情
     * @params $request mixed
     */
    public function shopcontent(Request $request)
    {
        $goods_id=$request->goods_id;
        $goodsInfo=Index::where('goods_id',$goods_id)->first();
//        print_R($goodsInfo);die;
        // 商品轮播图
        $goods_imgs=$goodsInfo['goods_imgs'];
        $goods_imgs=rtrim($goods_imgs,'|');
        $goods_imgs=explode('|',$goods_imgs);
        return view('goods/shopcontent',['goodsInfo'=>$goodsInfo,'goods_imgs'=>$goods_imgs]);
    }
}
