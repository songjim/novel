<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/3/7
 * Time: 下午10:41
 */

namespace Admin\Controller;


use Think\Controller;

class CronController extends Controller
{
    public function crons()
    {
        $flag = session('email_flag');
        system("'aa'>>/tmp/tst.txt");
        echo 'aaaaaasongjian';
//        if ($flag != ''){
//            $email = S($flag);
//            $subject = 'C NOVEL 注册邮件';
//            $name = 'C NOVEL';
//            $code = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
//            $r_code = substr(str_shuffle($code),0,6);
//            $content = "尊敬的用户,你好!"."</br>"."下面是你在C NOVEL的验证码:".$r_code;
//            think_send_mail($email,$name,$subject,$content);
//            session('email_flag',null);
//            S($flag,null);
//        }

    }
}
