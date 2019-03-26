@extends('master')
@section('title')
    慕希
@endsection
@section('content')
<link href="{{url('css/login.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('css/vccode.css')}}" rel="stylesheet" type="text/css" />
<!--触屏版内页头部-->
@csrf
<div class="m-block-header" id="div-header">
    <strong id="m-title">登录</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="home-icon"></i></a>
</div>

<div class="wrapper">
    <div class="registerCon">
        <div class="binSuccess5">
            <ul>
                <li class="accAndPwd">
                    <dl>
                        <div class="txtAccount">
                            <input id="txtAccount" type="text" name="user_tel" placeholder="请输入您的手机号码/邮箱"><i></i>
                        </div>
                        <cite class="passport_set" style="display: none"></cite>
                    </dl>
                    <dl>
                        <input id="txtPassword" type="password" name="user_pwd" placeholder="密码" value="" maxlength="20" /><b></b>
                    </dl>
                    <dl>
                        <input id="verifycode" type="text" name="user_code" placeholder="请输入验证码"  maxlength="4" /><b></b>
                        <img src="{{url('/verify/create')}}" alt="" id="img">
                    </dl>
                </li>
            </ul>
            <a id="btnLogin" href="javascript:;" lay-submit lay-filter="*" class="orangeBtn loginBtn">登录</a>
        </div>
        <div class="forget">
            <a href="https://m.1yyg.com/v44/passport/FindPassword.do">忘记密码？</a><b></b>
            <a href="{{url('login/register')}}">新用户注册</a>
        </div>
    </div>
    <div class="oter_operation gray9" style="display: none;">
        
        <p>登录666潮人购账号后，可在微信进行以下操作：</p>
        1、查看您的潮购记录、获得商品信息、余额等<br />
        2、随时掌握最新晒单、最新揭晓动态信息
    </div>
</div>
@section('my-js')
<script>
    $(function(){
        layui.use(['layer'],function(){
            var loginflag=false;
            var layer=layui.layer;
            $('#btnLogin').click(function(){
                var user_tel=$('#txtAccount').val();
                var user_pwd=$('#txtPassword').val();
                var user_code=$('#verifycode').val();
                if(user_tel==''){
                    layer.msg('手机号不能为空');
                    return loginflag;
                }
                if(!(/^1[34578]\d{9}$/.test(user_tel))){
                    layer.msg('手机号格式错误');
                    return loginflag;
                }
                if(user_pwd==''){
                    layer.msg('密码不能为空');
                    return loginflag;
                }
                if(user_code==''){
                    layer.msg('验证码不能为空');
                    return loginflag;
                }
                // return false;

                $.post(
                    "logindo",
                    {user_tel:user_tel,user_pwd:user_pwd,user_code:user_code,_token:$('input[name=_token]').val()},
                    function(res){
                        // console.log(res)
                        if(res==0){
                            layer.msg('验证码填写错误')

                        }else if(res==1||res==2){
                            layer.msg('账号或密码错误');

                        }else{
                            layer.msg('登陆成功');
                            location.href = "{{url('cart/cartlist')}}";
                        }
                    }
                )
            });


        })
    })

    $("#img").click(function(){
        $(this).attr('src',"{{url('/verify/create')}}"+"?"+Math.random())
    })
</script>
@endsection


