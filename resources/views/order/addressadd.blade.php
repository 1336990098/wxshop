@extends('master')
@section('title')
    慕希
@endsection
@section('content')

<link rel="stylesheet" href="{{url('css/writeaddr.css')}}">
<link rel="stylesheet" href="{{url('dist/css/LArea.css')}}">
<!--触屏版内页头部-->

<div class="m-block-header" id="div-header">
    <strong id="m-title">填写收货地址</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="javascript:;"  class="m-index-icon">保存</a>
</div>
<div class=""></div>

<form class="" action="{{url('OrderController/addressadddo')}}">
    <input type="hidden" class="_token" name="_token" value="{{csrf_token()}}">
    <div class="addrcon">
        <ul>
            <li><em>收货人</em><input class="address_name"  name="address_name" type="text" placeholder="请填写真实姓名"></li>
            <li><em>手机号码</em><input lay-verify="required|phone" class="address_tel" name="address_tel" type="number" placeholder="请输入手机号"></li>
            {{--<input id="demo1" type="text" readonly="" name="address_detail" placeholder="请选择所在区域">--}}
            <li><em>所在区域</em>
                <select id="province" class="area">
                    <option value="" selected>--请选择--</option>
                    @foreach($area as $v)
                        <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                </select>

                <select id="city" class="area">
                    <option value="0" selected>--请选择--</option>
                </select>
                <select id="area" class="area">
                    <option value="0" selected>--请选择--</option>
                </select>
            </li>
            <li class="addr-detail"><em>详细地址</em><input class="address_detail" name="address_detail" type="text" placeholder="20个字以内" class="addr"></li>
        </ul>
        <div class="setnormal layui-form"><span>设为默认地址</span><input type="checkbox" class="is_default" name="is_default" lay-skin="switch">  </div>
    </div>
</form>
@endsection
<!-- SUI mobile -->
<script src="{{url('dist/js/LArea.js')}}"></script>
<script src="{{url('dist/js/LAreaData1.js')}}"></script>
<script src="{{url('dist/js/LAreaData2.js')}}"></script>
@section('my-js')
<script>
    $(function(){
        layui.use(['form','layer'], function(){
            var form = layui.form();
            var layer = layui.layer;
            //收货地址 三级联动
            $(document).on('change','.area',function(){
                var _this=$(this);
                //获取option的value值
                var id=_this.val();
                var _option="<option selected value=''>--请选择--</option>";
                _this.nextAll('select').html(_option);
                //向控制器传值
                $.post(
                    "getarea",
                    {id:id,'_token':'{{csrf_token()}}'},
                    function(res){
                        if(res.code==1){
                            for(var i in res['data']){
                                _option+="<option value='"+res['data'][i]['id']+"'>"+res['data'][i]['name']+"</option>";
                            }
                            _this.next('select').html(_option);
                        }else{
                            layer.msg(res.font,{icon:res.code});
                        }
                    }
                    ,'json'
                )
            })

            //验证收货人唯一
            $(document).on('blur','.address_name',function(){
                var address_name=$('.address_name').val();
                var reg=/^.{3,18}$/
                if(address_name==''){
                    layer.msg('请填写收货人');
                    return false;
                }else if(!reg.test(address_name)){
                    layer.msg('收货人至少填写三位');
                    return false;
                }
            });
            //手机号失焦
            $(document).on('blur','.address_tel',function(){
                var address_tel=$('.address_tel').val();
                var regTel=/^1[34578]\d{9}$/;
                if(address_tel==''){
                    layer.msg('请填写手机号');
                    return false;
                }else if(!regTel.test(address_tel)){
                    layer.msg('请填写正确的手机号')
                    return false;
                }
            })
            //点击保存
            $(document).on('click','.m-index-icon',function(){
                var obj={};
                obj.address_name=$('.address_name').val();
                obj.address_tel=$('.address_tel').val();
                obj.province=$('#province').val();
                obj.city=$('#city').val();
                obj.area=$('#area').val();
                obj.address_detail=$('.address_detail').val();
                var _token=$('._token').val();
                var is_default=$('.is_default').prop('checked');
                if(is_default==false){
                    obj.is_default=2
                }else{
                    obj.is_default=1
                }
                // console.log(obj.province);
                var reg=/^.{3,18}$/
                if(obj.address_name==''){
                    layer.msg('请填写收货人');
                    return false;
                }else if(!reg.test(obj.address_name)){
                    layer.msg('收货人至少填写三位');
                    return false;
                }
                var regTel=/^1[34578]\d{9}$/;
                if(obj.address_tel==''){
                    layer.msg('请填写手机号');
                    return false;
                }else if(!regTel.test(obj.address_tel)){
                    layer.msg('请填写正确的手机号')
                    return false;
                }
                if(obj.address_detail==''){
                    layer.msg('请填写完整收货地址');
                    return false;
                }
                if(obj.province==''){
                    layer.msg('请选择完整的收货地址');
                    return false;
                }
                $.post(
                    "addressadddo",
                    {obj,_token},
                    function(res){
                        if(res.code==1){
                            layer.msg(res.font,{icon:res.code});
                            location.href="address"
                        }

                        // console.log(res);
                    }
                    ,'json'
                );

            })
        })
    });

</script>
@endsection
