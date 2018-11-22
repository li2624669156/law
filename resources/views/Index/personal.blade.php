<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>个人中心</title>
    <link rel="stylesheet" type="text/css" href="/css/ui.css">
    <link href="/css/mui.min.css" rel="stylesheet" />
    <link href="/css/style.css" rel="stylesheet" />
    <script src="/js/jquery-3.2.1.min.js"></script>

</head>
<body>
<div class="aui-container">
    <div class="aui-page">
        <div class="aui-page-my">
            <div class="aui-my-info">
                <div class="aui-my-info-back"></div>
                <a href="javascript:;" class="">
						<span  >
							<!--<img src="../img/icon-png/my-aw.jpg" class="aui-my-avatar">-->
							<span id='top'>
                                @if(session('user.img_url')   == '')
                                    <img src="/images/user-tx.png" class="aui-my-avatar" id='tops'>
                                @else
                                    <img src="{{session('user.img_url')}}" class="aui-my-avatar" id='tops'>
                                @endif
							</span>
							<div id='user' style="position:relative;margin-top:-35px;padding-bottom: 20px;text-align:center;color:#fff;"  >
								<span id='phone'>{{session('user.nickname')}}</span>
							</div>
						</span>
                </a>
                <div class="aui-mt-location aui-l-red"></div>

            </div>
            <div class="aui-l-content">
                <div class="aui-menu-list aui-menu-list-clear">
                    <ul>
                        <li class="b-line">
                            <a href="/images/my-put.html">
                                <div class="aui-icon"><img src="/images/icon-home/my-in1.png"></div>
                                <h3>个人信息</h3>
                                <div class="aui-time"><i class="aui-jump"></i></div>
                            </a>
                        </li>
                        <li class="b-line">
                            <a href="contact.html">
                                <div class="aui-icon"><img src="/images/icon-home/my-in2.png"></div>
                                <h3>常用联系人</h3>
                                <div class="aui-time"><i class="aui-jump"></i></div>
                            </a>
                        </li>
                        <li class="b-line">
                            <a href="./orderJi.html">
                                <div class="aui-icon"><img src="/images/icon-home/my-in5.png"></div>
                                <h3>今日订单</h3>
                                <div class="aui-time"><i class="aui-jump"></i></div>
                            </a>
                        </li>
                        <li class="b-line">
                            <a href="./Ordermi.html">
                                <div class="aui-icon"><img src="/images/icon-home/my-in4.png"></div>
                                <h3>未完成的订单</h3>
                                <div class="aui-time"><i class="aui-jump"></i></div>
                            </a>
                        </li>
                        <li class="b-line">
                            <a href="./Orderwan.html">
                                <div class="aui-icon"><img src="/images/icon-home/my-in3.png"></div>
                                <h3>已完成的订单</h3>
                                <div class="aui-time"><i class="aui-jump"></i></div>
                            </a>
                        </li>
                        <li class="b-line">
                            <a href="modify.html">
                                <div class="aui-icon"><img src="/images/icon-home/my-in6.png"></div>
                                <h3>修改密码</h3>
                                <div class="aui-time"><i class="aui-jump"></i></div>
                            </a>
                        </li>
                        <li class="b-line">
                            <a href="video.html">
                                <div class="aui-icon"><img src="/images/icon-home/my-in6.png"></div>
                                <h3>视频播放</h3>
                                <div class="aui-time"><i class="aui-jump"></i></div>
                            </a>
                        </li>
                        <li class="b-line">
                            <a href="Music.html">
                                <div class="aui-icon"><img src="/images/icon-home/my-in6.png"></div>
                                <h3>音乐播放</h3>
                                <div class="aui-time"><i class="aui-jump"></i></div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="/js/mui.min.js"></script>
<script src="/js/app.js"></script>
<script>
</script>
<script>


</script>

</html>