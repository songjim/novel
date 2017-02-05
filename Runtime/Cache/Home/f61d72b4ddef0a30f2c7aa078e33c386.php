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
<!--主体-->
<div class="wrap">

    <!--start头部-->
    <div class="header reg-header ">
        <div class="box-center">
            <div class="logo cf"><span class="lang">用户注册</span></div>
        </div>
    </div>
    <!--end头部-->

    <!--start注册模块-->
    <div class="reg-wrap">
        <div class="reg-step">
            <span class="lang act">填写注册信息</span>
        </div>
        <div class="reg-form-wrap">
            <form action="">
                <div class="reg-form-list form-list">
                    <dl>
                        <dd id="email_dd">
                            <em>邮箱账号</em>
                            <input type="text" placeholder="输入常用邮箱地址" id="txtemail">
                        </dd>
                        <dd id="phonepwd">
                            <em>密码</em>
                            <input type="password" id="txtphonepwd" placeholder="6-18位大小写字母、符号或数字">
                            <div class="password-tip" style="display:none">
                                <span><cite></cite></span>
                                <p id="pwdrule1">长度为6-18个字符</p>
                                <p id="pwdrule2">不能是9位以下的纯数字</p>
                                <p id="pwdrule3">不能包含空格</p>
                            </div>
                            <div class="password-strong" style="display:none">
                                <!-- 以下3个 不会重复出现，目前3个一起出现造成的换行问题请无视 -->
                                <p style="display:none"><span class="level-1"><b></b></span>弱</p>
                                <p style="display:none"><span class="level-2"><b></b></span>中</p>
                                <p style="display:none"><span class="level-3"><b></b></span>强</p>
                            </div>
                        </dd>
                        <dd id="password2">
                            <em>确认密码</em>
                            <input id="txtphonepwd2" type="password" placeholder="再次输入密码">
                        </dd>
                    </dl>
                    <div class="deal">
                        <input type="checkbox" id="deal" name="checkbox" checked>
                        <label for="deal" class="ui-checkbox"></label><label for="deal">我已阅读并同意</label><a href="javascript:void(0)" target="_blank">《用户服务协议》</a>
                    </div>
                    <a class="red-btn go-reg" href="javascript:" id="btnMailRegister">立即注册</a>

                </div>
            </form>
        </div>
    </div>
    <!--end注册模块-->

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

<script src="./js/jquery-1.12.4.min.js"></script>
<script src="./js/common.js"></script>
<!--注册页面js-->
<script src="./js/register.js"></script>
</body>

</html>