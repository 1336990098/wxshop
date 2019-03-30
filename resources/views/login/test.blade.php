<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        li{
            list-style: none;
            float:left;
            margin-left:3%;
        }
    </style>
</head>
<body>

    <div class="lll">
        <input type="text" name="search" id="search" value="{{$search}}">
        <input type="button" value="搜索" id="btn">
        @foreach($goodsInfo as $v)
            <p>{{$v->goods_name}}</p>
        @endforeach
        <div>
            {{ $goodsInfo->appends(['search' => $search])->render() }}
        </div>
    </div>
</body>
</html>
<script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
<script>
    $(function(){
        $('#btn').click(function(){
            var search=$('#search').val();
            $.ajax({
                type:"post",
                url:"test",
                data:{search:search,_token:'{{csrf_token()}}'},
                success:function(res){
                    $('.lll').html(res);
                }
            })
        })
    })
</script>