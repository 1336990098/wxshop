<?php

namespace App\Http\Controllers;
use App\Model\Index;
use Illuminate\Http\Request;
use App\Model\Category;
class IndexController extends Controller
{
    //商城首页
    public function index()
    {
        $cateInfo=Category::where(['pid'=>0])->get();
        $goodsInfo=Index::get();
//        print_R($goodsInfo);
        return view('index',['goodsInfo'=>$goodsInfo,'cateInfo'=>$cateInfo]);
    }
    //我的潮购
    public function userpage()
    {
        $user_id = session('user');

        if(empty($user_id)){

            return redirect('login/login');
        }else{
            return view('userpage');
        }

    }
    //晒单
    public function share(){
        return view('share');
    }
    //晒单
    public function sharedetail(){
        return view('sharedetail');
    }
    //登录
    public function login(){
        return view('login/login');
    }
}
