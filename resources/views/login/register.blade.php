@extends('master')
@section('title')
    慕希
@endsection
@section('content')
    @csrf
<link href="{{url('css/login.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('css/vccode.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
<!--触屏版内页头部-->

<div class="m-block-header" id="div-header">
    <strong id="m-title">注册</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>
    <div class="wrapper">
        <input name="hidForward" type="hidden" id="hidForward" />
        <div class="registerCon">
            <ul>
                <li class="accAndPwd">
                    <dl>
                        <s class="phone"></s><input id="userMobile" name="user_tel" maxlength="11" type="number" placeholder="请输入您的手机号码" value="" />
                        <span class="clear">x</span>
                    </dl>
                    <dl>
                        <s class="password"></s>
                        <input  id="code" maxlength="4" value="" type="text" placeholder="请输入验证码1234" />
                        <button class="sendcode" id="btna">获取验证码</button>
                    </dl>
                    <dl>
                        <s class="password"></s>
                        <input class="pwd" id="pwd1" maxlength="11" name="user_pwd" type="text" placeholder="6-16位数字、字母组成" value="" />
                        <input class="pwd"  maxlength="11" name="user_pwd" type="password" placeholder="6-16位数字、字母组成" value="" style="display: none" />
                        <span class="mr clear">x</span>
                        <s class="eyeclose"></s>
                    </dl>
                    <dl>
                        <s class="password"></s>
                        <input class="conpwd" id="pwd2" maxlength="11" name="pwd1" type="text" placeholder="请确认密码" value="" />
                        <input class="conpwd"  maxlength="11" name="pwd1" type="password" placeholder="请确认密码" value="" style="display: none" />
                        <span class="mr clear">x</span>
                        <s class="eyeclose"></s>
                    </dl>
                    <dl class="a-set">
                        <i class="gou"></i><p>我已阅读并同意《666潮人购购物协议》</p>
                    </dl>

                </li>
                <li><a id="btnNext" href="javascript:;" class="orangeBtn loginBtn">下一步</a></li>
            </ul>
        </div>

<div class="layui-layer-move"></div>
@endsection

@section('my-js')
<script>
    $(function(){
        $('#btna').click(function(){
            var u_name=$('#userMobile').val();
            $.post(
                "{{url('sendcode')}}",
                {u_name:u_name,_token:$('input[name=_token]').val()},
                function(res){
                    console.log(res)
                }
            )
        });
        $('#userMobile').blur(function(){
            var user_tel=$(this).val();
            // console.log(user_tel);
            $.post(
                "registerdo",
                {tel:user_tel,_token:$('input[name=_token]').val()},
                function(res){
                    if(res==2){
                        alert('手机号已存在');
                        location.href = "{{url('login/register')}}";

                    }
                    // console.log(res);
                }
            )
        });
        $('.registerCon input').bind('keydown',function(){
            var that = $(this);
            if(that.val().trim()!=""){

                that.siblings('span.clear').show();
                that.siblings('span.clear').click(function(){
                    console.log($(this));

                    that.parents('dl').find('input:visible').val("");
                    $(this).hide();
                })

            }else{
               that.siblings('span.clear').hide();
            }

        })
        function show(){
            if($('.registerCon input').attr('type')=='password'){
                $(this).prev().prev().val($("#passwd").val());
            }
        }
        function hide(){
            if($('.registerCon input').attr('type')=='text'){
                $(this).prev().prev().val($("#passwd").val());
            }
        }
        $('.registerCon s').bind({click:function(){
            if($(this).hasClass('eye')){
                $(this).removeClass('eye').addClass('eyeclose');

                $(this).prev().prev().prev().val($(this).prev().prev().val());
                $(this).prev().prev().prev().show();
                $(this).prev().prev().hide();


            }else{
                    console.log($(this  ));
                    $(this).removeClass('eyeclose').addClass('eye');
                    $(this).prev().prev().val($(this).prev().prev().prev().val());
                    $(this).prev().prev().show();
                    $(this).prev().prev().prev().hide();

                 }
             }
         })

        function registertel(){
            // 手机号失去焦点
            $('#userMobile').blur(function(){
                reg=/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[06-8])\d{8}$/;//验证手机正则(输入前7位至11位)
                var falseflag;
                var that = $(this);
                if( that.val()==""|| that.val()=="请输入您的手机号")
                {
                    layer.msg('请输入您的手机号！');
                    return falseflag=false;
                }
                else if(that.val().length<11)
                {
                    layer.msg('您输入的手机号长度有误！');
                    return falseflag=false;
                }
                else if(!reg.test($("#userMobile").val()))
                {
                    layer.msg('您输入的手机号不存在!');
                    return falseflag=false;

                }
                else if(that.val().length == 11){
                    // ajax请求后台数据
                }
            })
            // 密码失去焦点
            $('.pwd').blur(function(){
                var pwdflag=false;
                reg=/^[0-9a-zA-Z]{6,16}$/;
                var that = $(this);
                if( that.val()==""|| that.val()=="6-16位数字或字母组成")
                {
                    layer.msg('请设置您的密码！');
                    return pwdflag;
                }else if(!reg.test($(".pwd").val())){
                    layer.msg('请输入6-16位数字或字母组成的密码!');
                    return pwdflag;
                }
            })
            // 重复输入密码失去焦点时
            $('.conpwd').blur(function(){
                var flaga=false;
                var that = $(this);
                var pwd1 = $('.pwd').val();
                var pwd2 = that.val();
                if(pwd1!=pwd2){
                    layer.msg('您俩次输入的密码不一致哦！');
                    return flaga;
                }
            })

        }
            registertel();
        // 购物协议
        $('dl.a-set i').click(function(){
            var that= $(this);
            if(that.hasClass('gou')){
                that.removeClass('gou').addClass('none');
                $('#btnNext').css('background','#ddd');

            }else{
                that.removeClass('none').addClass('gou');
                $('#btnNext').css('background','#f22f2f');
            }

        })
        // 下一步提交
        $('#btnNext').click(function(){
            if($('#userMobile').val()==''){
                layer.msg('请输入您的手机号！');
            }else if($('.pwd').val()==''){
                layer.msg('请输入您的密码!');
            }else if($('.conpwd').val()==''){
                layer.msg('请您再次输入密码！');
            }else{
                layui.use(['form','layer'],function(){
                    var form=layui.form;
                    var layer=layui.layer;
                    var tel=$('#userMobile').val();
                    var pwd1=$('#pwd1').val();
                    var pwd2=$('#pwd2').val();
                    var code=$('#code').val();
                    // console.log(code);
                    $.ajax({
                        url:"{{url('login/registerdo')}}",
                        type:'post',
                        data:{'user_tel':tel,'pwd2':pwd2,'user_code':code,'user_pwd':pwd1,'_token': $('input[name=_token]').val()},
                        success: function(res){
                            // console.log(res);
                            if(res==1){
                                alert('注册成功');
                                location.href = "{{url('cart/cartlist')}}";
                            }else if(res==8){
                                alert('注册失败');
                                location.href = "{{url('login/register')}}";
                            }else if(res==2){
                                layer.msg('账号已存在');
                                location.href = "{{url('login/register')}}";
                            }else if(res==4){
                                alert('验证码错误');
                                location.href = "{{url('login/register')}}";
                            }else if(res==5){
                                alert('两次密码不一致');
                                location.href = "{{url('login/register')}}";
                            }
                        }
                    })

                });
            }
        })


    })
</script>

@endsection
