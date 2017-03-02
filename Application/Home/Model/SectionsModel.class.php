<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/5
 * Time: 下午5:23
 */

namespace Home\Model;


use Think\Model;

class SectionsModel extends Model
{
    protected $tableName = 'sections';
    protected $_map = array(
        'name' => 'section_name',
    );
//    protected $_link = array(
//        '关联1'  =>  array(
//            '关联属性1' => '定义',
//            '关联属性N' => '定义',
//        ),
//        '关联2'  =>  array(
//            '关联属性1' => '定义',
//            '关联属性N' => '定义',
//        ),
//        '关联3'  =>  HAS_ONE, // 快捷定义
//         ...
//    );
    // 定义自动验证
    protected $_validate    =   array(
        array('title','require','标题必须'),
    );
    // 定义自动完成
    protected $_auto    =   array(
        array('create_time','time',1,'function'),
    );
}