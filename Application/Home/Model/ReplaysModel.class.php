<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/15
 * Time: 下午8:28
 */

namespace Home\Model;


use Think\Model;

class ReplaysModel extends Model
{
    protected $_validate = array(
        array('r_content','require','评论信息不能为空',1),
        array('forum_id','require','不为空',1),
    );

    protected $_auto = array(
        array('user_id','getUserId',3,'callback'),
        array('created_at','getTime',3,'callback'),
    );

    protected function getTime()
    {
        $time = date('Y-m-d H:i:s');

        return $time;
    }

    protected function getUserId()
    {
        $id = session('user_id');
        return $id;
    }
}