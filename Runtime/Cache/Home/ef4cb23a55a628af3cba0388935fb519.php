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
                        <a class="black" id="msg-btn" href="<?php echo U('HomePage/personalshow');?>" target="" data-eid="qd_A09">
                            消息<cite id="msg-box">(<i>99</i>)</cite></a><em>|</em>
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
<link rel="stylesheet" type="text/css" href="/Public/css/category.css" />
<!--导航-->
<div class="main-nav-wrap" data-l1="3">
    <div class="main-nav box-center cf">
        <ul>
            <?php if(is_array($categories)): $i = 0; $__LIST__ = $categories;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><li class="nav-li"><a href="<?php echo U('HomePage/categoryshow',array('category_id'=>$category[id]));?>" data-eid="qd_A15"><?php echo ($category["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            <!--<li class="nav-li"><a href="<?php echo U('HomePage/categoryshow');?>" data-eid="qd_A15">都市</a></li>-->
            <!--<li class="nav-li"><a href="" data-eid="qd_A16">灵异</a></li>-->
            <!--<li class="nav-li"><a href="" data-eid="qd_A17">武侠</a></li>-->
            <!--<li class="nav-li"><a href="" data-eid="qd_A18">仙侠</a></li>-->
            <li class="nav-li"><a href="<?php echo U('HomePage/forumshow');?>" target="_blank" data-eid="qd_A19">论坛</a></li>
        </ul>
    </div>
</div>
<!--导航-->
    <!--&lt;!&ndash;导航&ndash;&gt;-->
    <!--<div class="main-nav-wrap" data-l1="3">-->
        <!--<div class="main-nav box-center cf">-->
            <!--<ul>-->
                <!--<li class="nav-li"><a href="" data-eid="qd_A15">都市</a></li>-->
                <!--<li class="nav-li"><a href="" data-eid="qd_A16">灵异</a></li>-->
                <!--<li class="nav-li"><a href="" data-eid="qd_A17">武侠</a></li>-->
                <!--<li class="nav-li"><a href="" data-eid="qd_A18">仙侠</a></li>-->
                <!--<li class="nav-li"><a href="" target="_blank" data-eid="qd_A19">论坛</a></li>-->
            <!--</ul>-->
        <!--</div>-->
    <!--</div>-->
    <!--&lt;!&ndash;导航&ndash;&gt;-->

    <!--小说列表-->
    <div class="all-pro-wrap box-center cf">
        <!--start推荐书籍-->
        <div class="focus-wrap mb40 cf">
            <div class="channel-focus small-mode fl">
                <div class="small-list cf">
                    <ul>
                        <?php if(is_array($recommends)): $i = 0; $__LIST__ = $recommends;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$recommend): $mod = ($i % 2 );++$i;?><li>
                                <div class="book-shadow"></div>
                                <div class="img-box">
                                    <a href="">
                                        <img src="<?php echo ($recommend["book_img"]); ?>" alt="">
                                    </a>
                                </div>
                                <h3>
                                    <a href="<?php echo U('Books/showsections',array('book_id'=>$recommend[id]));?>"><?php echo ($recommend["book_name"]); ?></a>
                                </h3>
                                <p>@<?php echo ($recommend["author"]); ?></p>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <!--<li>-->
                            <!--<div class="book-shadow"></div>-->
                            <!--<div class="img-box">-->
                                <!--<a href="">-->
                                    <!--<img src="" alt="">-->
                                <!--</a>-->
                            <!--</div>-->
                            <!--<h3>-->
                                <!--<a href="">雪鹰领主</a>-->
                            <!--</h3>-->
                            <!--<p>@小钢炮</p>-->
                        <!--</li>-->
                    </ul>
                </div>
            </div>
            <div class="notice-wrap fr">
                <div class="notice-box">
                    <div class="edit-rec">
                        <h3>简介</h3>
                        <p><?php echo ($current_category["description"]); ?></p>
                        <!--<p>ksfjksdjfksdjfksdjfksdjfkjsfdkjdskdfjks ksfjksdjfksdjfksdjfksdjfkjsfdkjdskdfjks ksfjksdjfksdjfksdjfksdjfkjsfdkjdskdfjks</p>-->
                        <!--<p>ksfjksdjfksdjfksdjfksdjfkjsfdkjdskdfjks ksfjksdjfksdjfksdjfksdjfkjsfdkjdskdfjks ksfjksdjfksdjfksdjfksdjfkjsfdkjdskdfjks</p>-->
                    </div>
                </div>
            </div>
        </div>
        <!--end推荐书籍-->
        <div class="main-content-wrap fl" data-l1="5">
            <div class="all-book-list">
                <div class="book-img-text">
                    <ul class="all-img-list cf">
                        <?php if(is_array($all_book)): $i = 0; $__LIST__ = $all_book;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$book): $mod = ($i % 2 );++$i;?><li data-rid="1">
                                <div class="book-img-box">
                                    <a href="//book.qidian.com/info/3513193" data-bid="3513193" data-eid="qd_B57" target="_blank">
                                        <img src="<?php echo ($book["book_img"]); ?>" />
                                    </a>
                                </div>
                                <div class="book-mid-info">
                                    <h4><a href="<?php echo U('Books/showsections',array('book_id'=>$book[id]));?>" target="_blank" data-eid="qd_B58" data-bid="3513193"><?php echo ($book["book_name"]); ?></a></h4>
                                    <p class="author">
                                        <img src="//qidian.gtimg.com/qd/images/ico/user.0.1.png">
                                        <a class="name" href="#" data-eid="qd_B59" target="_blank"><?php echo ($book["author"]); ?></a>
                                        <em>|</em>
                                        <a href="" target="_blank" data-eid="qd_B60">玄幻</a>
                                        <i>·</i>
                                        <a class="go-sub-type" data-typeid="21" data-subtypeid="73" href="javascript:" data-eid="qd_B61">异世大陆</a>
                                        <em>|</em>
                                        <span>连载中</span>
                                    </p>
                                    <p class="intro">
                                        <?php echo ($book["description"]); ?>
                                    </p>
                                    <p class="update">
                                        <span>279.3万字</span>
                                    </p>
                                </div>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <!--<li data-rid="1">-->
                            <!--<div class="book-img-box">-->
                                <!--<a href="//book.qidian.com/info/3513193" data-bid="3513193" data-eid="qd_B57" target="_blank">-->
                                    <!--<img src="" />-->
                                <!--</a>-->
                            <!--</div>-->
                            <!--<div class="book-mid-info">-->
                                <!--<h4><a href="//book.qidian.com/info/3513193" target="_blank" data-eid="qd_B58" data-bid="3513193">雪鹰领主</a></h4>-->
                                <!--<p class="author">-->
                                    <!--<img src="//qidian.gtimg.com/qd/images/ico/user.0.1.png">-->
                                    <!--<a class="name" href="#" data-eid="qd_B59" target="_blank">我吃西红柿</a>-->
                                    <!--<em>|</em>-->
                                    <!--<a href="" target="_blank" data-eid="qd_B60">玄幻</a>-->
                                    <!--<i>·</i>-->
                                    <!--<a class="go-sub-type" data-typeid="21" data-subtypeid="73" href="javascript:" data-eid="qd_B61">异世大陆</a>-->
                                    <!--<em>|</em>-->
                                    <!--<span>连载中</span>-->
                                <!--</p>-->
                                <!--<p class="intro">-->
                                    <!--在夏族的安阳行省，有一个很小很不起眼的领地，叫——雪鹰领！故事，就从这里开始！**继《莽荒纪》《吞噬星空》《九鼎记》《盘龙》《星辰变》《寸芒》《星峰-->
                                <!--</p>-->
                                <!--<p class="update">-->
                                    <!--<span>279.3万字</span>-->
                                <!--</p>-->
                            <!--</div>-->
                        <!--</li>-->
                        <!--<li data-rid="1">-->
                            <!--<div class="book-img-box">-->
                                <!--<a href="//book.qidian.com/info/3513193" data-bid="3513193" data-eid="qd_B57" target="_blank"><img src="//qidian.qpic.cn/qdbimg/349573/3513193/150"></a>-->
                            <!--</div>-->
                            <!--<div class="book-mid-info">-->
                                <!--<h4><a href="//book.qidian.com/info/3513193" target="_blank" data-eid="qd_B58" data-bid="3513193">雪鹰领主</a></h4>-->
                                <!--<p class="author">-->
                                    <!--<img src="//qidian.gtimg.com/qd/images/ico/user.0.1.png">-->
                                    <!--<a class="name" href="#" data-eid="qd_B59" target="_blank">我吃西红柿</a>-->
                                    <!--<em>|</em>-->
                                    <!--<a href="" target="_blank" data-eid="qd_B60">玄幻</a>-->
                                    <!--<i>·</i>-->
                                    <!--<a class="go-sub-type" data-typeid="21" data-subtypeid="73" href="javascript:" data-eid="qd_B61">异世大陆</a>-->
                                    <!--<em>|</em>-->
                                    <!--<span>连载中</span>-->
                                <!--</p>-->
                                <!--<p class="intro">-->
                                    <!--在夏族的安阳行省，有一个很小很不起眼的领地，叫——雪鹰领！故事，就从这里开始！**继《莽荒纪》《吞噬星空》《九鼎记》《盘龙》《星辰变》《寸芒》《星峰-->
                                <!--</p>-->
                                <!--<p class="update">-->
                                    <!--<span>279.3万字</span>-->
                                <!--</p>-->
                            <!--</div>-->
                        <!--</li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--小说列表-->


<!--主体-->
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