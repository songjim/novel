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
<link rel="stylesheet" type="text/css" href="/Public/css/view.css" />

    <!--start论坛-->
    <div class="box-center forumboard">
        <div class="bm bw0 pgs cl">
            <span>
                <div class="pg">
                    <strong>1</strong>
                    <a href="">2</a>
                    <a href="">3</a>
                    <a href="">4</a>
                    <a href="" class="nxt">下一页</a>
                </div>
            </span>
            <span class="pgb y">
                <a href="">返&nbsp;回</a>
            </span>
            <a href="" id="newspecial">发新帖</a>
        </div>
        <!--论坛内容-->
        <div id="postlist" class="pl bm">
            <table cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td class="pls ptn pbn f13">
                        <div class="hm ptn">
                            <span class="xg1">查看:</span> <span class="xi1">10598</span><span class="pipe">|</span><span
                                class="xg1">回复:</span> <span class="xi1">99</span>
                        </div>
                    </td>
                    <td class="plc ptm pbn vwthd">
                        <h1 class="ts">
                            <span></span>
                            <a href="<?php echo U('HomePage/forumshow',array('category_id'=>$forum['category_id']));?>">[<?php echo ($forum["category_name"]); ?>]</a>
                            <span id="thread_subject"><?php echo ($forum["name"]); ?></span>
                        </h1>
                    </td>
                </tr>
                </tbody>
            </table>
            <!--start论坛分割线-->
            <table cellspacing="0" cellpadding="0" class="ad">
                <tbody><tr>
                    <td class="pls">
                    </td>
                    <td class="plc">
                    </td>
                </tr>
                </tbody>
            </table>
            <!--end论坛分割线-->
            <!--start论坛item-->

            <div>
                <table class="plhin" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td class="pls" rowspan="2">
                            <div class="pls favatar">
                                <div class="pi">
                                    <div class="authi">
                                        <a href="964883" target="_blank" class="xw1 f13" style="color: #000000"><?php echo ($forum["user_name"]); ?></a>
                                    </div>
                                </div>
                                <div>
                                    <div class="avatar">
                                        <a href="" class="avtm" target="_blank">
                                            <img src="<?php echo ($forum["user_img"]); ?>">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="plc f13">
                            <div class="pi">
                                <strong>
                                    <a href="">
                                        1楼
                                    </a>
                                </strong>
                                <div class="pti">
                                    <div class="authi">
                                        <img class="authicn vm" src="/Public/img/ico_lz.png">
                                        &nbsp;楼主
                                        <span class="pipe">|</span>
                                        <em>发表于 <?php echo ($forum["created_at"]); ?></em>
                                    </div>
                                </div>
                            </div>
                            <div class="pct">
                                <div class="pcb">
                                    <div class="t_fsz">
                                        <table cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td class="t_f">
                                                    <?php echo ($forum["content"]); ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr class="ad">
                        <td class="pls"></td>
                        <td class="plc"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <?php if(is_array($replays)): $i = 0; $__LIST__ = $replays;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$replay): $mod = ($i % 2 );++$i;?><!--end论坛item--><!--start论坛item-->
                <div>
                    <table class="plhin" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td class="pls" rowspan="2">
                                <div class="pls favatar">
                                    <div class="pi">
                                        <div class="authi">
                                            <a href="964883" target="_blank" class="xw1 f13" style="color: #000000"><?php echo ($replay["user_name"]); ?></a>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="avatar">
                                            <a href="" class="avtm" target="_blank">
                                                <img src="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="plc f13">
                                <div class="pi">
                                    <strong>
                                        <a href="">
                                            <?php echo ($key+2); ?>楼
                                        </a>
                                    </strong>
                                    <div class="pti">
                                        <div class="authi">
                                            <em>发表于 <?php echo ($replay["created_at"]); ?></em>
                                        </div>
                                    </div>
                                </div>
                                <div class="pct">
                                    <div class="pcb">
                                        <div class="t_fsz">
                                            <table cellspacing="0" cellpadding="0">
                                                <tbody>
                                                <tr>
                                                    <td class="t_f">
                                                        <?php echo ($replay["r_content"]); ?>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php if(($replay["children"] != '')): ?><!--<if condition="($user_name eq '')">-->
                                        <div class="cm">
                                            <h3 class="psth xs1">
                                                <span class="icon_ring vm"></span>
                                                点评
                                            </h3>
                                            <!--<?php echo ($replay["children"]); ?>-->
                                            <?php if(is_array($replay["children"])): $i = 0; $__LIST__ = $replay["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><div class="pstl xs1 cl">
                                                <div class="psta vm">
                                                    <a href="">
                                                        <img src="" alt="">
                                                    </a>
                                                    <a href="<?php echo ($child["user_img"]); ?>" class="xi2 xw1">
                                                        <?php echo ($child["user_name"]); ?>
                                                    </a>
                                                </div>
                                                <div class="psti">
                                                    <?php echo ($child["r_content"]); ?>
                                                    <a href="" class="xi2">回复</a>
                                                    <span class="xg1">
                                                            发表于 <?php echo ($child["created_at"]); ?>
                                                        </span>
                                                </div>
                                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                            <?php else: endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td class="pls"></td>
                            <td class="plc" style="overflow:visible;">
                                <div class="po">
                                    <div class="pob cl f13">
                                        <em>
                                            <a href="<?php echo U('Forums/replayShow',array('category_id'=>$forum['category_id'],'forum_id'=>$forum['id'],'replay_id'=>$replay['id']));?>" class="fastre">回复</a>
                                        </em>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="ad">
                            <td class="pls"></td>
                            <td class="plc"></td>
                        </tr>
                        </tbody>
                    </table>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <!--end论坛item-->
        </div>

        <!--start下一页-->
        <div class="pgbtn">
            <a href="" class="bm_h">
                下一页 »
            </a>
        </div>
        <!--end下一页-->

        <!--start回复-->
        <div class="pgs mtm mbm cl">
            <a href="" id="post_replytmp">
                回复
            </a>
        </div>
        <!--end回复-->

        <div class="pl bm bmw" id="f_pst">
            <form action="<?php echo U('Forums/editReplays');?>" method="post">
                <table cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td class="pls">
                            <div class="avatar avtm">
                                <img src="" alt="">
                            </div>
                        </td>
                        <td class="plc">
                            <div class="cl">
                                <div class="hasfsl">
                                    <input type="hidden" name="forum_id" value="<?php echo ($forum["id"]); ?>">
                                    <textarea name="r_content" id="" cols="30" rows="10" calss="is-login"></textarea>
                                </div>
                            </div>
                            <div class="ptm pnpost">
                                <button class="pn pnc vm" type="submit">
                                    <strong>发表回复</strong>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <!--end论坛-->

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