<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/5
 * Time: 下午5:23
 */

namespace Home\Model;


use Think\Model;

class SectionsModel extends Model\RelationModel
{
//    protected $tableName = 'sections';
//    protected $_map = array(
//        'name' => 'section_name',
//    );
    protected $_link = array(
        'Books' => array(
            'mapping_type'  => self::BELONGS_TO,
            'class_name'    => 'Books',
            'foreign_key'   => 'book_id',
            'mapping_name'  => 'books',
            ),
        'Articles' => array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'Articles',
            'mapping_name'  => 'articles',

        ),
    );
    // 定义自动验证
    protected $_validate    =   array(
        array('name','require','标题不为空'),
    );

}