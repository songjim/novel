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
                <?php if(($user_name != '')): ?><div class="sign-in">
                        <span>你好，<?php echo ($user_name); ?></span>
                        <a class="black" id="user-name" href="//me.qidian.com" target="_blank" data-eid="qd_A08"></a>
                        <em>|</em>
                        <a class="black" id="msg-btn" href="//me.qidian.com/msg/systems.aspx?page=1" target="_blank" data-eid="qd_A09">
                            消息<cite id="msg-box">(<i></i>)</cite></a><em>|</em>
                        <a id="exit-btn" href="<?php echo U('Login/logout');?>" data-eid="qd_A10">退出</a>
                    </div>
                    <?php else: ?>
                    <div class="sign-out">
                        <a id="login-btn" class="black" href="javascript:" data-eid="qd_A06">登录</a>
                        <em>|</em>
                        <a id="reg-btn" href="<?php echo U('Register/register');?>" target="_blank" data-eid="qd_A07">注册</a>
                    </div><?php endif; ?>
                <!--<div class="sign-in">-->
                    <!--<span>你好，<?php echo ($user_name); ?></span>-->
                    <!--<a class="black" id="user-name" href="//me.qidian.com" target="_blank" data-eid="qd_A08"></a>-->
                    <!--<em>|</em>-->
                    <!--<a class="black" id="msg-btn" href="//me.qidian.com/msg/systems.aspx?page=1" target="_blank" data-eid="qd_A09">-->
                        <!--消息<cite id="msg-box">(<i></i>)</cite></a><em>|</em>-->
                    <!--<a id="exit-btn" href="javascript:" data-eid="qd_A10">退出</a>-->
                <!--</div>-->
            </div>
            <!--登录注册框-->
        </div>
    </div>
    <!--头部-->
<link rel="stylesheet" type="text/css" href="/Public/css/vote_popup.css" />


    <!--start阅读主体容器-->
    <div class="read-main-wrap font-family01" style="font-size: 18px; z-index: 101;" id="j_readMainWrap">
        <div id="j_chapterBox" data-l1="3">
            <div class="text-wrap" id="j_textWrap" data-cid="315522893">
                <!-- start 阅读区块容器 -->
                <div class="text-wrap" id="j_textWrap" data-cid="315522893">
                    <!-- start 阅读正文章节容器 -->
                    <div class="read-container">
                        <!-- start 封面版权信息 -->
                        <div class="book-cover-wrap">
                            <div class="book-photo">
                                <img src="<?php echo ($article["book_img"]); ?>">
                            </div>
                            <h1><?php echo ($article["book_name"]); ?></h1>
                            <h2>
                                <a href="JavaScript:void(0);" target="_blank"><?php echo ($article["author"]); ?></a>著
                            </h2>
                            <div class="info-list cf">
                                <ul>
                                    <li><p><?php echo ($article["name"]); ?></p><span>类型</span></li>

                                    <li><em><?php echo ($create_time); ?></em><span>上架</span></li>
                                    <li><p><em><?php echo ($up_article["name"]); ?></em>章</p><span>连载（章节）</span></li>
                                </ul>
                            </div>
                            <h5>本书由起点中文网首发</h5>
                            <h6>©版权所有 侵权必究</h6>
                        </div>
                        <!-- end 封面版权信息 -->
                    </div>
                    <!-- end 阅读正文章节容器 -->
                </div>
                <!-- end 阅读区块容器 -->
                <!--start阅读快容器-->
                <div class="text-wrap" id="chapter-315522893">
                    <div class="main-text-wrap">
                        <div class="text-head">
                            <div class="guide-box" style="display: none;">
                                <cite></cite>
                                <p>点击书签后，可收藏每个章节的书签，“阅读进度”可以在个人中心书架里查看</p>
                            </div>
                            <a class="book-mark" href="javascript:" title="书签"></a>
                            <h3 class="j_chapterName"><?php echo ($article["section_name"]); ?></h3>
                            <div class="text-info cf">
                                <!-- start 书信息 -->
                                <div class="info fl">
                                    <a href="http://book.qidian.com/info/1003694333" target="_blank"><em class="iconfont"></em><?php echo ($article["book_name"]); ?></a>
                                    <a href="http://me.qidian.com/authorIndex.aspx?id=4362443" target="_blank"><em class="iconfont"></em><?php echo ($article["author"]); ?></a>
                                    <i><em class="iconfont"></em><span class="j_chapterWordCut">2490</span>字</i>
                                    <i><em class="iconfont"></em><span class="j_updateTime"><?php echo ($up_time); ?></span></i>
                                </div>
                                <!-- end 书信息 -->
                            </div>
                        </div>
                        <!--start正文内容-->
                        <div class="read-content j_readContent">
                            <?php echo ($article['body']); ?>
                        </div>
                        <!--end正文内容-->
                    </div>
                </div>
                <!--end阅读快容器-->
            </div>
            <!-- start 章节控制器 -->
            <div class="chapter-control dib-wrap" data-l1="3">
                <a id="j_chapterPrev" class="disabled" href="javascript:void(0);">上一章</a><span>|</span>
                <a href="<?php echo U('Books/showsections',array('book_id'=>$article['book_id']));?>">目录</a><span>|</span>
                <?php echo ($article['section_id']+=1); ?>
                <a id="j_chapterNext" href="<?php echo U('Books/showarticle',array('section_id'=>$article['section_id'],'book_id'=>$article['book_id']));?>">下一章</a>
            </div>
            <!-- end 章节控制器 -->
        </div>
    </div>
    <!--end阅读主体容器-->

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
                            <input type="text" tabindex="1" placeholder="请输入邮箱" id="email" autocomplete="off">
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