<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>选择用户</title>
    <link rel="stylesheet" type="text/css" href="/css/index/index_2f3dc5b.css"/>
</head>
<script src="/js/jquery-3.2.1.min.js"></script>
    <body class="body-box">

            <div class="banner-bar ban-index pr">
                <div class="ban-abs">
                    <div class="mui-slider-item mui-slider-item-duplicate">
                            <ul class="hd-mn-item clearfix">
                                <li class="mn-list-cr" id="yong">
                                    <a href="javascript:void(0)">
                                        <p>
                                            <i class="icon-hualv icon-unie929 mn-be"  style="font-size:100px;"></i>
                                        </p><span  style="color:#fff">我是用户</span>
                                    </a>
                                </li>
                                <li class="mn-list-cr" id="lv">
                                    <a href="javascript:void(0)">
                                        <p>
                                            <i  class="icon-hualv icon-unie926 mn-gn" style="font-size:100px;"></i>
                                        </p><span style="color:#fff">我是律师</span>
                                    </a>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
            <input type="hidden"  id ='isGe'  value="{{$isGe}}">
    </body>
</html>


<script >
    $('#yong').click(function(){
        var isGe = $('#isGe').val();
        $.ajax({
            url:'{{url('islv')}}',
            data:{isuser:1,isGe:isGe,'token':'{{csrf_token()}}'},
            type:'post',
            dataType:'json',
            success:function(json_info){
                if(json_info.status == 200){
                    location.href = json_info.url;
                }
            }
        });


    });
    $('#lv').click(function(){
        var isGe = $('#isGe').val();
        $.ajax({
            url:'{{url('islv')}}',
            data:{isuser:2,isGe:isGe,'token':'{{csrf_token()}}'},
            type:'post',
            dataType:'json',
            success:function(json_info){
                if(json_info.status == 200){
                    location.href = json_info.url;
                }
            }
        });

    });

</script>