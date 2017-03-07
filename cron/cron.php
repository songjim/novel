<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/3/8
 * Time: 上午1:07
 */
//require 'Redis.php';
require_once dirname(__FILE__) . '/../ThinkPHP/Library/Vendor/PHPMailer/class.phpmailer.php';
require_once(dirname(__FILE__) . '/../ThinkPHP/Library/Vendor/PHPMailer/class.smtp.php');
$redis = new Redis();
$redis->connect('127.0.0.1');
$a = $redis->get('email_flag');
echo $a;
$email = $redis->get($a);
if ($email != '') {
    echo $email;
    $subject = 'C NOVEL 注册邮件';
    $name = 'C NOVEL';
    $code_key = $a.'code';
    //$code = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    //$r_code = substr(str_shuffle($code),0,6);
    $r_code  = $redis->get($code_key);
    $content = "尊敬的用户,你好!"."</br>"."下面是你在C NOVEL的验证码:".$r_code;
    $mail = new PHPMailer();

    $mail->CharSet = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码

    $mail->IsSMTP(); // 设定使用SMTP服务

    $mail->SMTPDebug = 0; // 关闭SMTP调试功能

    // 1 = errors and messages

    // 2 = messages only

    $mail->SMTPAuth = true; // 启用 SMTP 验证功能

    $mail->SMTPSecure = 'ssl'; // 使用安全协议
    $mail->Mailer = 'SMTP';
    $mail->Host = 'smtp.gmail.com'; // SMTP 服务器

    $mail->Port = '465'; // SMTP服务器的端口号

    $mail->Username = 'sjtiande@gmail.com'; // SMTP服务器用户名

    $mail->Password = 'yongyuandeai1024'; // SMTP服务器密码

    $mail->SetFrom('sjtiande@gmail.com', 'C Novel');

    $replyEmail = 'sjtiande@gmail.com';

    $replyName = 'C Novel';

    $mail->AddReplyTo($replyEmail, $replyName);

    $mail->Subject = $subject;

    $mail->AltBody = "为了查看该邮件，请切换到支持 HTML 的邮件客户端";

    $mail->MsgHTML($content);

    $mail->AddAddress($email, $name);
    set_time_limit(60);
    $mail->Send();
    $redis->del($a);
}
exit();

