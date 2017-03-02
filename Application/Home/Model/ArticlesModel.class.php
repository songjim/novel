<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/6
 * Time: 上午12:16
 */

namespace Home\Model;


use Think\Model;

class ArticlesModel extends Model
{
    // 定义自动验证
    protected $_validate    =   array(
        array('title','require','标题必须'),
    );
    // 定义自动完成
    protected $_auto    =   array(
        array('create_time','time',1,'function'),
    );

}