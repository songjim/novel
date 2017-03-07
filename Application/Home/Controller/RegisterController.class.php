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
            $subject = 'C NOVEL 注册邮件';
            $name = 'C NOVEL';
            $code = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $r_code = substr(str_shuffle($code),0,6);
            $content = "尊敬的用户,你好!"."</br>"."下面是你在C NOVEL的验证码:".$r_code;
            $nk = time();
//            echo $nk;
//            session()
            $_SESSION['email_flag'] = $nk;
            $set = array(
                'type' =>'redis' ,
                'host'=>'127.0.0.1' ,
                'port'=>6379,
            );
            // 实例化
            $redis=S($set);
            $redis->$nk = $email;

//            S($nk,$email);
            session('email_flag',$nk);
            echo json_encode(array('success'=>true,'msg'=> ''));
//            $a = think_send_mail($email,$name,$subject,$content);
//            echo $r_code;
//            session('code',$r_code);
//            if ($a != true) {
//                think_send_mail('809587614@qq.com',$name,'C NOVEL发送失败',$this->error('发送失败'));
//            }
        }
    }
}