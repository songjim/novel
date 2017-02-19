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
<link rel="stylesheet" type="text/css" href="/Public/css/forum.css" />
    <!--start论坛-->
    <div class="box-center forumboard">
        <div class="bm bw0 pgs cl">
                <span>
                    <div class="pg">
                        <?php echo ($page); ?>
                        <!--<strong>1</strong>-->
                        <!--<a href="">2</a>-->
                        <!--<a href="">3</a>-->
                        <!--<a href="">4</a>-->
                        <!--<a href="" class="nxt">下一页</a>-->
                    </div>
                </span>
            <span class="pgb y">
                    <a href="">返&nbsp;回</a>
                </span>
            <a href="" id="newspecial">发新帖</a>
        </div>
        <!--start论坛导航-->
        <ul class="ttp bm cl">
            <li class="xw1 a">
                <a href="<?php echo U('HomePage/forumshow');?>">全部</a>
            </li>
            <?php if(is_array($categories)): $i = 0; $__LIST__ = $categories;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><li>
                    <a href="<?php echo U('HomePage/forumshow',array('category_id'=>$category['id']));?>"><?php echo ($category["name"]); ?></a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>

        </ul>
        <!--end论坛导航-->
        <!--start论坛列表-->
        <div class="tl bm bmw">
            <div class="bgfff">
                <form action="">
                    <table>
                        <tbody>
                        <tr class="ts">
                            <td class="w25">&nbsp;</td>
                            <th class="w760">
                                <a href="javascript:;" class="forumrefresh">板块主题</a>
                            </th>
                            <td class="w25">&nbsp;</td>
                            <td class="w25">&nbsp;</td>
                            <td class="">&nbsp;</td>
                        </tr>
                        </tbody>
                        <tbody>
                        <?php if(is_array($current_categories)): $i = 0; $__LIST__ = $current_categories;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$current_category): $mod = ($i % 2 );++$i;?><tr>
                                <td class="icn">
                                    <a href="">
                                        <img src="/Public/img/pollsmall.gif" alt="">
                                    </a>
                                </td>
                                <th class="new">
                                    <em>[<?php echo ($current_category["category_name"]); ?>]</em>
                                    <a href="<?php echo U('Forums/detailshow',array('forum_id'=>$current_category['id']));?>" class="s xst">
                                        <?php echo ($current_category["name"]); ?>
                                    </a>
                                </th>
                                <td class="by"></td>
                                <td class="num"></td>
                                <td class="by">
                                    <cite>
                                        <a href=""><?php echo ($current_category["user_name"]); ?></a>
                                    </cite>
                                    <em>
                                        <a href=""><?php echo ($current_category["updated_at"]); ?></a>
                                    </em>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <!--end论坛列表-->
        <!--start下一页-->
        <a href="" class="bm_h" id="autopbn">下一页</a>
        <!--end下一页-->
        <!--start发帖-->
        <div class="bm" id="f_pst">
            <div class="bm_h">
                <h2>快速发帖</h2>
            </div>
            <div class="bm_c bgfff">
                <form action="<?php echo U('Forums/editForums');?>" method="post" id="fastpostform">
                    <div class="pbt cl">
                        <div class="ftid">
                            <select name="category_id" id="category_id">
                                <?php if(is_array($categories)): $i = 0; $__LIST__ = $categories;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><option value="<?php echo ($category["id"]); ?>"><?php echo ($category["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <input type="text" name="name" class="px" style="width: 25em" />
                        </div>
                    </div>
                    <div class="cl">
                        <div class="hasfsl" id="fastposteditor">
                            <?php if(($user_name == '')): ?><div class="no-login">
                                    您需要登录后才可以发帖
                                    <a href="">登录</a>
                                    |
                                    <a href="<?php echo U('Register/register');?>">注册通行证</a>
                                </div>
                                <?php else: ?>
                                <textarea name="content" id="" cols="30" rows="10" calss="is-login"></textarea><?php endif; ?>
                            <!--start没有登录-->

                            <!--end没有登录-->
                            <!--start登录-->

                            <!--end登录-->
                        </div>
                        <?php if(($user_name != '')): ?><p class="ptm pnpost" type="submit">
                            <button class="pn pnc" type="submit">
                                <strong>发表帖子</strong>
                            </button>
                            <!--<input type="submit" value='发表'>-->
                        </p><?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
        <!--end发帖-->
    </div>
    <!--end论坛-->


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