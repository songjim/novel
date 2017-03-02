<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/22
 * Time: 下午11:09
 */

namespace Admin\Controller;


use Think\Controller;

class LoginController extends Controller
{
    public function loginShow()
    {
        $this->display();
    }

    public function login()
    {
        $email = I('post.email',0,'addslashes');
//        $pwd = I('')
        if (IS_POST) {
            // 实例化Login对象
            $login =M('Users');
            // 自动验证 创建数据集
//            if (!$data = $login->create()) {
//                // 防止输出中文乱码
//                header("Content-type: text/html; charset=utf-8");
//                exit($login->getError());
//            }
            // 组合查询条件

            $result = $login->where("email = '$email'")->field('id,user_name,password')->find();
            // 验证用户名 对比 密码
            if ($result && $result['password'] == md5($_REQUEST['password'])) {
                // 存储session
                session('user_id', $result['id']);          // 当前用户id
                session('user_name', $result['user_name']);   // 当前用户名
                $this->display('Login/homeshow');
//                echo json_encode(array('success'=>true,'url'=>U('Admin/homeshow')));
            } else {
                echo json_encode(array('success'=>false,'msg'=>'验证失败'));
            }
        } else {
            $this->display();
        }

    }
}