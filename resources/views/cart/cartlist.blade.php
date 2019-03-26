@extends('master')
@section('title')
    慕希啊
@endsection
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>购物车</title>
    <link href="{{url('css/cartlist.css')}}" rel="stylesheet" type="text/css" />
<body id="loadingPicBlock" class="g-acc-bg">
    <input name="hidUserID" type="hidden" id="hidUserID" value="-1" />
    <div>
        <!--首页头部-->
        <div class="m-block-header">
            <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
            <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
        </div>
        <!--首页头部 end-->
        <div class="g-Cart-list">
            <ul id="cartBody">
                @foreach($goodsInfo as $v)
                <li cart_id="{{$v->cart_id}}" class="ll">
                    <s class="xuan current"></s>
                    <a class="fl u-Cart-img" href="javascript:;">
                        <img src="/goodsimg/{{$v['goods_img']}}" border="0" alt="">
                    </a>
                    <div class="u-Cart-r">
                        <a href="/v44/product/12501977.do" class="gray6">{{$v['goods_name']}}</a>
                        <span class="gray9">
                            <em>价格: ￥<a href="javascript:;" class="self_price" self_price="{{$v->self_price}}">{{$v->self_price}}</a></em>
                            &nbsp;&nbsp;<em>剩余{{$v['goods_num']}}人次</em>
                        </span>
                        <div class="num-opt">
                            <em class="num-mius dis min"><i></i></em>
                            <input class="text_box" goods_id="{{$v->goods_id}}" goods_num="{{$v->goods_num}}" value="{{$v->buy_number}}" buy_number="{{$v->buy_number}}" name="num" type="text">
                            <em class="num-add add"><i></i></em>
                        </div>
                        <a href="javascript:;" name="delLink" isover="0" goods_id="{{$v->goods_id}}" class="z-del"><s></s></a>
                    </div>
                </li>
               @endforeach
            </ul>
            <div id="divNone" class="empty "  style="display: none"><s></s><p>您的购物车还是空的哦~</p><a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a></div>
        </div>
        <div id="mycartpay" class="g-Total-bt g-car-new" style="">
            <dl>
                <dt class="gray6">
                    <s class="quanxuan current"></s>全选
                    <p class="money-total">合计<em class="orange total"><span>￥</span>17.00</em></p>
                    
                </dt>
                <dd>
                    <a href="javascript:;" id="a_payment" class="orangeBtn w_account remove">删除</a>
                    <a href="{{url('order/payment')}}" id="a_payment" class="orangeBtn w_account">去结算</a>
                </dd>
            </dl>
        </div>
        <div class="hot-recom">
            <div class="title thin-bor-top gray6">
                <span><b class="z-set"></b>人气推荐</span>
                <em></em>
            </div>
            <div class="goods-wrap thin-bor-top">
                <ul class="goods-list clearfix">
                    <li>
                        <a href="https://m.1yyg.com/v44/products/23458.do" class="g-pic">
                            <img src="https://img.1yyg.net/goodspic/pic-200-200/20160908092215288.jpg" width="136" height="136">
                        </a>
                        <p class="g-name">
                            <a href="https://m.1yyg.com/v44/products/23458.do">(第<i>368671</i>潮)苹果（Apple）iPhone 7 Plus 128G版 4G手机</a>
                        </p>
                        <ins class="gray9">价值:￥7130</ins>
                        <div class="btn-wrap">
                            <div class="Progress-bar">
                                <p class="u-progress">
                                    <span class="pgbar" style="width:1%;">
                                        <span class="pging"></span>
                                    </span>
                                </p>
                            </div>
                            <div class="gRate" data-productid="23458">
                                <a href="javascript:;"><s></s></a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="" class="g-pic">
                            <img src="https://img.1yyg.net/goodspic/pic-200-200/20160908092215288.jpg" width="136" height="136">
                        </a>
                        <p class="g-name">
                            <a href="https://m.1yyg.com/v44/products/23458.do">(第368671潮)苹果（Apple）iPhone 7 Plus 128G版 4G手机</a>
                        </p>
                        <ins class="gray9">价值:￥7130</ins>
                        <div class="btn-wrap">
                            <div class="Progress-bar">
                                <p class="u-progress">
                                    <span class="pgbar" style="width:45%;">
                                        <span class="pging"></span>
                                    </span>
                                </p>
                            </div>
                            <div class="gRate" data-productid="23458">
                                <a href="javascript:;"><s></s></a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="https://m.1yyg.com/v44/products/23458.do" class="g-pic">
                            <img src="https://img.1yyg.net/goodspic/pic-200-200/20160908092215288.jpg" width="136" height="136">
                        </a>
                        <p class="g-name">
                            <a href="https://m.1yyg.com/v44/products/23458.do">(第<i>368671</i>潮)苹果（Apple）iPhone 7 Plus 128G版 4G手机</a>
                        </p>
                        <ins class="gray9">价值:￥7130</ins>
                        <div class="btn-wrap">
                            <div class="Progress-bar">
                                <p class="u-progress">
                                    <span class="pgbar" style="width:1%;">
                                        <span class="pging"></span>
                                    </span>
                                </p>
                            </div>
                            <div class="gRate" data-productid="23458">
                                <a href="javascript:;"><s></s></a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="https://m.1yyg.com/v44/products/23458.do" class="g-pic">
                            <img src="https://img.1yyg.net/goodspic/pic-200-200/20160908092215288.jpg" width="136" height="136">
                        </a>
                        <p class="g-name">
                            <a href="https://m.1yyg.com/v44/products/23458.do">(第368671潮)苹果（Apple）iPhone 7 Plus 128G版 4G手机</a>
                        </p>
                        <ins class="gray9">价值:￥7130</ins>
                        <div class="btn-wrap">
                            <div class="Progress-bar">
                                <p class="u-progress">
                                    <span class="pgbar" style="width:1%;">
                                        <span class="pging"></span>
                                    </span>
                                </p>
                            </div>
                            <div class="gRate" data-productid="23458">
                                <a href="javascript:;"><s></s></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        {{--底部--}}
    <div class="footer clearfix">
        <ul>
            <li class="f_home"><a href="{{url('/')}}" ><i></i>潮购</a></li> <!--class="hover"-->
            <li class="f_announced"><a href="{{url('goods/goodslist')}}"><i></i>全部商品</a></li>
            <li class="f_single"><a href="{{url('sharedetail')}}" ><i></i>晒单</a></li>
            <li class="f_car"><a id="btnCart" href="{{url('cart/cartlist')}} " class="hover" ><i></i>购物车</a></li>
            <li class="f_personal"><a href="{{url('userpage')}}" ><i></i>我的潮购</a></li>
        </ul>
    </div>
</body>

@section('my-js')
<script type="text/javascript">
    $(function () {
        layui.use('layer',function(){
            var layer=layui.layer;
            //点击加号
            $(".add").click(function () {
                var _this=$(this);
                //购买数量
                var buy_number=parseInt(_this.prev().val());
                //商品id
                var goods_id=parseInt(_this.prev().attr('goods_id'));
                //商品库存
                var goods_num=parseInt(_this.prev().attr('goods_num'));

                //加号具体控制
                if(buy_number>=goods_num){
                    _this.prop('disabled',true);
                    _this.siblings('.min').prop('disabled',false); //控制减号
                }else{
                    buy_number+=1;
                    _this.prev().val(buy_number);
                    $(this).siblings('.min').prop('disabled',false);
                }

                $.post(
                    "changeNum",
                    {goods_id:goods_id,buy_number:buy_number,'_token':'{{csrf_token()}}'},
                    function(res){
                        // console.log(res)
                        layer.msg(res.font,{icon:res.code});
                        // return false;
                    }
                    ,'json'
                );
                GetCount()
            })
            //点击减号
            $(".min").click(function () {
                var _this=$(this);
                //购买数量
                var buy_number=parseInt(_this.next().val());
                //商品id
                var goods_id=parseInt(_this.next().attr('goods_id'));
                //商品库存
                var goods_num=parseInt(_this.next().attr('goods_num'));

                //减号具体控制
                if(buy_number<=1){
                    _this.prop('disabled',true);
                    _this.siblings('.add').prop('disabled',false);
                }else{
                    buy_number=buy_number-1;
                    _this.next().val(buy_number);
                    $(this).siblings('.add').prop('disabled',false);
                }

                $.post(
                    "changeNum",
                    {goods_id:goods_id,buy_number:buy_number,'_token':'{{csrf_token()}}'},
                    function(res){
                        // console.log(res)
                        layer.msg(res.font,{icon:res.code});
                        return false;
                    }
                    ,'json'
                );
                GetCount()
            })
            // 全选
            $(".quanxuan").click(function () {
                if($(this).hasClass('current')){
                    $(this).removeClass('current');

                    $(".g-Cart-list .xuan").each(function () {
                        if ($(this).hasClass("current")) {
                            $(this).removeClass("current");
                        } else {
                            $(this).addClass("current");
                        }
                    });
                    GetCount();
                }else{
                    $(this).addClass('current');

                    $(".g-Cart-list .xuan").each(function () {
                        $(this).addClass("current");
                        // $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
                    });
                    GetCount();
                }


            });
            // 单选
            $(".g-Cart-list .xuan").click(function () {
                if($(this).hasClass('current')){


                    $(this).removeClass('current');

                }else{
                    $(this).addClass('current');
                }
                if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
                    $('.quanxuan').addClass('current');

                }else{
                    $('.quanxuan').removeClass('current');
                }
                // $("#total2").html() = GetCount($(this));
                GetCount();
                //alert(conts);
            });
            // 已选中的总额
            function GetCount() {
                var conts = 0;
                var aa = 0;
                $(".xuan").each(function () {
                    if($(this).attr('class')=='xuan current'){
                        var self_price=$(this).siblings("div[class='u-Cart-r']").find("a[class='self_price']").attr('self_price');
                        var buy_number=$(this).siblings("div[class='u-Cart-r']").find("input[class='text_box']").val()
                        conts+=parseInt(self_price)*parseInt(buy_number);
                    }
                });

                $(".total").html('<span>￥</span>'+(conts).toFixed(2));
            }
            GetCount();
            //删除
            $(document).on('click','.z-del',function(){
                var _this=$(this);
                var goods_id=_this.attr('goods_id');
                $.post(
                    "del",
                    {goods_id:goods_id,'_token':'{{csrf_token()}}'},
                    function(res){
                        layer.msg(res.font,{icon:res.code});
                        _this.parents('li').remove();
                    }
                    ,'json'
                )
            })
            //皮山
            $('#a_payment').click(function(){
                var _this=$(this)
                var _li=$("s[class='xuan current']").parent('li');
                // console.log(_li);
                var goods_id='';

                _li.each(function (index) {
                    // console.log($(this));
                    goods_id+=$(this).attr('cart_id')+',';
                })
                $.post(
                    "delall",
                    {cart_id:goods_id,'_token':'{{csrf_token()}}'},
                    function(res){
                        if(res.code==1){
                            layer.msg(res.font,{icon:res.code});
                            history.go(0);
                        }else {
                            layer.msg(res.font,{icon:res.code});

                        }
                    }
                    ,'json'
                )
            })

            //去结算
        })
    })
</script>
@endsection


