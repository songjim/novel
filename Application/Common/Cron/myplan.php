<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/3/8
 * Time: 上午12:11
 */
$flag = session('email_flag');
if ($flag != ''){
    $set = array(
        'type' =>'redis' ,
        'host'=>'127.0.0.1' ,
        'port'=>6379,
    );
    // 实例化
    $redis=S($set);
    $a = 'sogj';
    $redis->$a = 'xxxc';
    $email = $redis->get($flag);
//    $email = S($flag);
    $subject = 'C NOVEL 注册邮件';
    $name = 'C NOVEL';
    $code = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $r_code = substr(str_shuffle($code),0,6);
    $content = "尊敬的用户,你好!"."</br>"."下面是你在C NOVEL的验证码:".$r_code;
    think_send_mail($email,$name,$subject,$content);
    session('email_flag',null);
//    S($flag,null);
}
echo date("Y-m-d H:i:s")."执行定m时任务！" . "\r\n<br>";