<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/5
 * Time: 下午2:45
 */

namespace Home\Controller;


use Think\Controller;

class RegisterController extends Controller
{
    public function register()
    {
        $this->display();
    }
    public function sendCodeEmail(){
        $email = I('post.mail','','addslashes');
        if ($email != '') {
            $subject = 'C_NOVEL 注册邮件';
            $name = 'C_NOVEL';
            $code = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $r_code = substr(str_shuffle($code),0,6);
            $content = "尊敬的用户,你好!"."</br>"."下面是你在C_NOVEL的验证码:".$r_code;
            session('code',$r_code);
            echo $r_code;
//            if (think_send_mail($email,$name,$subject,$content)) {
//                session('code',$r_code);
//                var_dump($r_code);
//            } else {
//                var_dump('ERROR');
//                think_send_mail('809587614@qq.com',$name,'C_NOVEL发送失败',$this->error('发送失败'));
//            }
        }
    }
}