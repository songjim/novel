<?php
return array(
    //'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE' => 'mysql',     // 数据库类型
    'DB_HOST' => '127.0.0.1', // 服务器地址
    'DB_NAME' => 'novel',          // 数据库名
    'DB_USER' => 'root',      // 用户名
    'DB_PWD' => '',          // 密码
    'DB_PORT' => '3306',        // 端口
    'DB_PREFIX' => '',    // 数据库表前缀

    /* 默认设定 */
    //'DEFAULT_THEME'    => 'default', // 默认模板主题名称
    //    'DEFAULT_GROUP' => 'Home',  // 默认分组

    /* URL设置 */
    //    'URL_CASE_INSENSITIVE' => true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL' => 0,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式，提供最好的用户体验和SEO支持
    'URL_PATHINFO_DEPR' => '/',    // PATHINFO模式下，各参数之间的分割符号
    //    'URL_HTML_SUFFIX' => '.html',  // URL伪静态后缀设置

    /*页面Trace信息*/
    'SHOW_PAGE_TRACE' => true,

    /* 项目设定 */
    //    'APP_GROUP_LIST' => 'Home,Admin,Author',
    'THINK_EMAIL' => array(

            'SMTP_HOST' => 'smtp.qq.com', //SMTP服务
//        'SMTP_HOST' => '192.168.200.254',
        'SMTP_PORT' => '465', //SMTP服务器端口
        'MAIL_SMTPAUTH' =>TRUE,

                'SMTP_USER' => '809587614@qq.com', //SMTP服务器用户名

                'SMTP_PASS' => 'yongyuandeai', //SMTP服务器密码

        'FROM_EMAIL' => '809587614@qq.com', //发件人EMAIL

        'FROM_NAME' => '小明', //发件人名称

        'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）

        'REPLY_NAME' => '', //回复名称（留空则为发件人名称）

    ),
);