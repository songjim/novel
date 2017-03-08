<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/7
 * Time: 下午11:55
 */

namespace Home\Controller;

use Think\Controller;

/**
 * Class LoginController
 * @package Home\Controller
 */
class LoginController extends Controller
{
    /**
     * 用户登录
     */
    public function login()
    {
        // 判断提交方式
        if (IS_POST) {
            // 实例化Login对象
            $login = M('Users');
            // 自动验证 创建数据集
            if (!$data = $login->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($login->getError());
            }
            // 组合查询条件
            $result = $login->where("email = '{$data['email']}'")->field('id,user_name,password')->find();
            // 验证用户名 对比 密码
            if ($result && $result['password'] == md5($_REQUEST['password'])) {
                // 存储session
                session('user_id', $result['id']);          // 当前用户id
                session('user_name', $result['user_name']);   // 当前用户名
                echo json_encode(array('success'=>true,'url'=>U('HomePage/homeshow')));
            } else {
                echo json_encode(array('success'=>false,'msg'=>'验证失败'));
            }
        } else {
            $this->display();
        }
    }

    /**
     * 用户注册
     */
    public function register()
    {
        // 判断提交方式 做不同处理
        if (IS_POST) {
            $email = I('post.email','','addslashes');
            $password = I('post.password','','addslashes');
            $code = I('post.code','','addslashes');
            if (empty($email) || empty($password)) {
                echo json_encode(array('success'=>false,'msg'=>'用户名或密码为空!'));
                exit();
            }
            $r_code = session('code');
            if (empty($code) || $code != $r_code) {
                echo json_encode(array('success'=>false,'msg'=>'验证码错误!'));
                exit();
            }

            // 实例化User对象
            $user = D('Users');
            // 自动验证 创建数据集
            if (!$data = $user->create()) {

                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($user->getError());
            }
            //插入数据库
            if ($id = $user->add($data)) {
                session('user_name',$user->user_name);
                session('user_id',$id);
                session('code',null);
                echo json_encode(array('success'=>true,'url'=>U('HomePage/homeshow')));
//                $this->error('注册成功', U('HomePage/homeshow'));
            } else {
                echo json_encode(array('success'=>false,'msg'=>'注册失败'));
            }
        }
    }

    /**
     * 用户注销
     */
    public function logout()
    {
        // 清楚所有session
        session(null);
        redirect(U('HomePage/homeshow'));
    }

    /**
     * 验证码
     */
    public function verify()
    {
        // 实例化Verify对象
        $verify = new \Think\Verify();
        // 配置验证码参数
        $verify->fontSize = 14;     // 验证码字体大小
        $verify->length = 4;        // 验证码位数
        $verify->imageH = 34;       // 验证码高度
        $verify->useImgBg = true;   // 开启验证码背景
        $verify->useNoise = false;  // 关闭验证码干扰杂点
        $verify->entry();
    }
}
