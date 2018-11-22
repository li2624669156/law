<!DOCTYPE HTML>
<html>
<head>
    <meta charset="gbk" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>仿找法网触屏手机wap法律网站模板律师在线-【shenghuofuwu/chaxun/】</title>
    <meta name="keywords" content="广州律师  广州律师在线 广州法律咨询  律师" /><meta name="description" content="找法网广州律师网为您提供广州律师在线法律咨询服务和法律法规、法律知识查询。解决法律难题 请找广州律师，专业律师在线为您提供全面的广州法律咨询服务。" />		<link type="text/css" href="law_css/law_touch.css" rel="stylesheet" />
    <script type="text/javascript" src="law_css/mobi.min.js" charset="gbk"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
<header class="sub_header">
    <a href="law_knowledge" class="b_link">首页</a>
    <h1 class="sub_title">律师投稿</h1>
    <style>
        #erweima{
            margin-left:560px;
        }
    </style>
</header>
<form id="erweima">
    <ul>
        <li>
            <img src="{{$url}}" alt="" style="margin-left:50px;width:200px;height: 200px;"/>
        </li>
    </ul>
</form>
<script>
    window.onload=function(){
        function a(){
            $.get("{{url('pc_gaozi_add')}}",
                { },
                function(data){
                    console.log(data);
                    if(data.msg == '进入律师投稿页面'){
//                            alert(data.msg);
                        location.href="/tougao"
                    }else if(data.msg == '未扫码'){
//                            alert(data.msg);
                        location.href='/pc_tougao'
                    }else if(data.msg == '此用户不存在'){
                        alert(data.msg);
//                            location.href='/login';
                    }else if(data.msg == '此用户不是律师'){
                        alert(data.msg);
                        location.href='tiaozhuan';
                    }
                }
            )
        }
        setInterval(a,2000);
    }
</script>

<a class="tips_box" href="../tel_3A400-676-8333"><div class="tips_inbox"><span class="tips_tel">400-676-8333</span><span class="tips_inbox-text">点击免费咨询律师</span></div></a>
<footer class="f16 tc c666">
    <p class="copyright">Copyright@2003-2014　版权所有 找法网（Findlaw.cn）- 中国最大的法律服务平台</p>
</footer>
</body>
</html>
<script type="text/javascript">

    $(function(){
        $(window).bind("scroll",function(){
            if(document.body.scrollTop>60){
                $(".tips_box").show();
            }else{
                $(".tips_box").hide();
            }
        });
    });

    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F16f2e7c9bbcd505f4a9cf6e267e10b0c' type='text/javascript'%3E%3C/script%3E"));
    $(document).ready(function(){
        var $a = $('body>a');
        $a[$a.length - 1].style.display = 'none';
    });
</script>