<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首次关注类型设置</title>
    <link rel="stylesheet" href="{{url('css/style/weui.css')}}">
</head>
<body>
<div class="weui-cells__title">请选择类型</div>
<div class="weui-cells weui-cells_radio">
    <label class="weui-cell weui-check__label" for="x11">
        <div class="weui-cell__bd">
            <p>图文消息 <span class="con"></span></p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" value="news" class="weui-check" name="radio1" id="x11"/>
            <span class="weui-icon-checked"></span>
        </div>
    </label>

    <label class="weui-cell weui-check__label" for="x12">

        <div class="weui-cell__bd">
            <p>图片消息 <span class="con"></span></p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" value="image" class="weui-check" id="x12"/>
            <span class="weui-icon-checked"></span>
        </div>
    </label>

    <label class="weui-cell weui-check__label" for="x13">
        <div class="weui-cell__bd">
            <p>视频消息 <span class="con"></span></p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" class="weui-check" value="video" name="radio1" id="x13"/>
            <span class="weui-icon-checked"></span>
        </div>
    </label>

    <label class="weui-cell weui-check__label" for="x14">

        <div class="weui-cell__bd">
            <p>文本消息 <span class="con"></span></p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" value="text" class="weui-check" id="x14" />
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <input id="btn" type="button" class="weui-btn weui-btn-primary" value="提交" style="background-color:green">
</div>
</body>
</html>
<script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("input[type='radio']").each(function(){
            var type = $(this).val();
            var data = '{{$type}}';
            if(type == data){
                $(this).attr('checked','checked');
            }
        })
    });
    $('#btn').click(function(){
        var type = $("input[type='radio']:checked").val();
        var result = confirm("您选择的是"+type+"类型是否确认");
        if(result){
            $.post(
                "{{url('/admin/wxtypedo')}}",
                {type:type,'_token':'{{csrf_token()}}'},
                function(res){

                }
            );
        }else{
            history.go(0)
        }
    });

</script>