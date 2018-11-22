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
</header>
<style>
    #text{
        margin-left:28px;
    }
    #submit{
        margin-top:10px;
    }
</style>
<div style="width:100%;height:100%;margin-left:45px;" id="text">
    {{--<div style=" overflow:scroll; width:400px; height:400px;”>  overflow-y:auto; overflow-x:auto; --}}
    <table>
        <tr>
            <td>
                <input type="text" name="title" style="border:solid yellow 1px;width:200px;;height:50px;margin-top:10px;" placeholder="请输入稿子标题">
            </td>
        </tr>
        <tr>
            <td>
                <textarea name="content" style="width:300px;height:200px;margin-top:10px;" id="content"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <a style="margin-top: 10px;">稿子类型</a>&nbsp;&nbsp;
                <select name="cate_id" style="margin-top: 10px;">
                    @foreach($cate_data as $k=>$v)
                        <li>
                            <option value="{{$v['cate_id']}}" id="cate_id">{{$v['catename']}} </option>
                        </li>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <input type="button" value="提交稿子" id="submit">
            </td>
        </tr>
    </table>
</div>
<script>
    $("#submit").click(function() {
        //获取稿子标题
        var title = $("[name=title]").val();
        //获取稿子内容
        var content = $("[name=content]").val();
        //获取稿子类型
        var cate_id = $("[name=cate_id]").val();
      if(title == ''){
            alert('稿子标题 不能为空！请注意');
            return false;
      }
        if(content == ''){
            alert('稿子内容 不能为空！请注意');
            return false;
        }
        $.ajax({
            url:"{{url('gaozi_add')}}",
            type:'post',
            data:{title:title,content:content,cate_id:cate_id},
            dataType:'json',
            success:function(res){
                if(res.msg == '投稿成功') {
                    alert('投稿成功');
                    window.location.href="tiaozhuan";
                }else{
                    alert('投稿失败');
                    window.location.href="/tougao";
                }
            }
        });
    })
</script>
<a class="tips_box" href="../tel_3A400-676-8333">
    <div class="tips_inbox"><span class="tips_tel">400-676-8333</span>
        <span class="tips_inbox-text">点击免费咨询律师</span>
    </div>
</a>
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
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F16f2e7c9bbcd505f4a9cf6e267e10b0c
