<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>小说</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" type="text/css" href="/Public/css/Autocomplete.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/Button.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/pact.css" />
</head>

<body>
<!--主体-->
<div class="wrap">

    <!--头部-->
    <div class="top-nav" data-l1="1">
        <div class="box-center cf">
            <!--登录注册框-->
            <div class="login-box fr">
                <div class="sign-in hidden">
                    <span>你好，</span>
                    <a class="black" id="user-name" href="//me.qidian.com" target="_blank" data-eid="qd_A08"></a>
                    <em>|</em>
                    <a class="black" id="msg-btn" href="//me.qidian.com/msg/systems.aspx?page=1" target="_blank" data-eid="qd_A09">
                        消息<cite id="msg-box">(<i></i>)</cite></a><em>|</em>
                    <a id="exit-btn" href="javascript:" data-eid="qd_A10">退出</a>
                </div>
                <div class="sign-out">
                    <a id="login-btn" class="black" href="javascript:" data-eid="qd_A06">登录</a>
                    <em>|</em>
                    <a id="reg-btn" href="<?php echo U('Register/register');?>" target="_blank" data-eid="qd_A07">注册</a>
                </div>
            </div>
            <!--登录注册框-->
        </div>
    </div>
    <!--头部-->
<link rel="stylesheet" type="text/css" href="/Public/css/list.css" />
    <!--start书详情容器-->
    <div class="book-detail-wrap center990">
        <div class="book-information cf">
            <!--start书封面-->
            <div class="book-img">
                <a class="J-getJumpUrl" id="bookImg" href="">
                    <img src="//qidian.qpic.cn/qdbimg/349573/1003617647/180&#10;">
                </a>
            </div>
            <!--end书封面-->
            <!--start书信息-->
            <div class="book-info">
                <h1>
                    <em>蛮荒记世</em>
                    <span>
                            <a class="writer" href="javascript:void(0);" target="_blank" data-eid="qd_G08">寻匿</a> 著
                        </span>
                </h1>
                <p class="tag">
                    <span class="blue">连载</span>
                </p>
                <p class="intro">
                    肆意挥洒激情的游戏人生，打破现实框架的无尽幻想！
                </p>
                <p>
                    <em>3.73</em>
                    <cite>万字</cite>
                </p>
                <p>
                    <a href="<?php echo U('Books/showarticle','article_id=1');?>" class="red-btn J-getJumpUrl ">开始阅读</a>
                </p>
            </div>
            <!--end书信息-->

        </div>

        <!--start区块导航-->
        <div class="content-nav-wrap cf">
            <div class="nav-wrap fl">
                <ul>
                    <li class="j_catalog_block act">
                        <a href="javascript:void(0);" class="lang">目录</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--end区块导航-->

        <!--start目录模块-->
        <div class="catalog-content-wrap">
            <!--start置顶按钮-->
            <div class="go-top">
                <div class="go-top-wrap">
                    <a href="javascript:void(0);" class="icon-go-top J-go-top">
                        <em class="iconfont" data-eid="qd_G72">TOP</em>
                    </a>
                </div>
            </div>
            <!--end置顶按钮-->

            <div class="volume-wrap">
                <div class="volume">
                    <h3>正文卷</h3>
                    <ul class="cf">
                        <?php if(is_array($sections)): $i = 0; $__LIST__ = $sections;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$section): $mod = ($i % 2 );++$i;?><li><a href=""><?php echo ($section["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!--end目录模块-->

    </div>
    <!--end书详情容器-->


    <!--页脚-->
    <div class="footer">
        <!--start 友情链接-->
        <div class="box-center cf">
            <!--start 版权-->
            <div class="copy-right">
                <p><span>Copyright © 2002-2017 All Right Reserved</span>版权所有 xxxxxxx</p>
                <p>本站所收录作品、社区话题、书库评论及本站所做之广告均属个人行为，与本站立场无关</p>
            </div>
            <!--end 版权-->
        </div>
    </div>
    <!--页脚-->
</div>
<!--主体-->

<!--登录遮罩-->
<!--<div class="mask"></div>-->
<div class="qdlogin-wrap hidden">
    <div class="login-wrap fl">
        <a class="close" id="close" href="javascript:"><em class="iconfont">X</em></a>

        <div class="login-tab cf" id="j_loginTab">
            <ul>
                <li class="lang act stat" tab="qidian" data-stat="qd_L01|账号登录|1">帐号登录</li>
            </ul>
        </div>

        <!-- start 登录切换容器 -->
        <div class="login-switch-wrap" id="j_loginSwitchWrap">
            <!-- start 起点登录 -->
            <div class="qd-login login-box " style="display: block;">

                <!-- start 普通登录 -->
                <div class="normal-login" id="j_normalLogin">
                    <div class="error-tip hidden"></div>
                    <ul>
                        <li>
                            <em class="iconfont"></em>
                            <input type="text" tabindex="1" placeholder="请输入邮箱" id="username" autocomplete="off">
                        </li>
                        <li>
                            <em class="iconfont"></em>
                            <input type="password" tabindex="2" id="password" placeholder="密码" autocomplete="off">
                        </li>
                    </ul>
                    <div class="auto-login-box cf">
                        <div class="link fr">
                            <a href="<?php echo U('Register/register');?>" target="_blank" id="regQd">免费注册</a>
                        </div>
                        <input type="checkbox" id="autologin" tabindex="3" name="checkbox" checked="checked">
                        <label for="autologin" class="ui-checkbox stat" data-stat="qd_L04|勾选自动登录|2" data-off-stat="qd_L05|取消自动登录|2"></label>
                        <label for="autologin">自动登录</label>
                    </div>
                    <a class="red-btn go-login btnLogin" tabindex="4" href="javascript:">登 录</a>
                </div>
                <!-- end 普通登录 -->

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/Public/js/common.js"></script>
</body>

</html>