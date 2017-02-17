<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/12
 * Time: 下午4:21
 */

namespace Home\Model;


use Think\Model;

class ForumsModel extends Model
{
    protected $_validate = array(
        array('category_id', 'require', '分类不能为空', 0),
        array('name', 'require', '帖子名不能为空', 0),
        array('content', 'require', '帖子内容不能为空'), // 内置正则验证邮箱格式
    );
    /**
     * 自动完成
     */
    protected $_auto = array(
        array('user_id','getUserId',3,'callback'),
    );

    protected function getUserId()
    {
        $id = session('user_id');

        return $id;
    }
}