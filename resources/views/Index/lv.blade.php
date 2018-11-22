<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link rel="stylesheet" href="falv/css/new_file.css" />
    <script type="text/javascript" src="falv/js/jquery-2.1.1.js" ></script>
    <link rel="stylesheet" href="falv/layer/mobile/need/layer.css" />
    <script type="text/javascript" src="falv/layer/mobile/layer.js" ></script>
    <!--<script type="text/javascript" src="js/new_file.js" ></script>-->
    <title>律师认证</title>
</head>
<body>
<header>律师认证</header>
<form name="form1" action="#" method="post">
    <div class="div_f">
        <div class="div_col" id="me">
            <div class="div_c_l"><span>手机号</span></div>
            <div class="div_c_r"><input type="text" name="phoe" id="phoe" placeholder="请输入手机号">
            </div>
        </div>
        <div style="clear:both"></div>
    </div>
    <input type="hidden" id="uid" value="{{session('uid')}}"><br><br>
    <div class="div_f">
        <div class="div_col" id="me">
            <div class="div_c_l"><span>真实姓名</span></div>
            <div class="div_c_r"><input type="text" name="realname" id="yq" value="" placeholder="请输入真实姓名">
            </div>
        </div>
        <div style="clear:both"></div>
    </div>
    <button id="submit" class="btn_1" type="button">认证</button>
</form>
</body>
</html>
<script>
    $(function(){

        //手机号
        $(".btn_1").click(function(){
            var phoe  = $("#phoe").val();
            var uid  = $("#uid").val();
            var realname  = $("[name=realname]").val();
            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1}))+\d{8})$/;
            if(phoe ==""){
                layer.open({
                    content: '手机号不能为空',
                    style: 'background:rgba(0,0,0,0.6); color:#fff; border:none;',
                    time:3
                });
                return false;
            }else if(phoe.length > 11 || phoe.length< 11){
                layer.open({
                    content: '手机号格式有误',
                    style: 'background:rgba(0,0,0,0.6); color:#fff; border:none;',
                    time:3
                });
                return false;
            }
            if(realname == ''){
                layer.open({
                    content: '真实姓名不能为空',
                    style: 'background:rgba(0,0,0,0.6); color:#fff; border:none;',
                    time:3
                });
                return false;
            }
            if(uid == ''){
                layer.open({
                    content: '系统有误！',
                    style: 'background:rgba(0,0,0,0.6); color:#fff; border:none;',
                    time:3
                });
                return false;
            }
            $.ajax({
                url:'{{url('registerIv')}}',
                data:{phoe:phoe,realname:realname,uid:uid,token:'{{csrf_token()}}'},
                type:'post',
                dataType:'json',
                success:function(json_info){
                    if(json_info.status == 200){
                            if(json_info.msg == '请等待管理员的认证！'){
                                layer.open({
                                    content:'请等待管理员的认证！' ,
                                    style: 'background:rgba(0,0,0,0.6); color:#fff; border:none;',
                                    time:3
                                });
                                return false;
                            }else{
                                location.href = json_info.url;
                            }
                    }else{
                        layer.open({
                            content:json_info.msg ,
                            style: 'background:rgba(0,0,0,0.6); color:#fff; border:none;',
                            time:3
                        });
                        return false;
                    }
                }
            });
        })





    });
</script>