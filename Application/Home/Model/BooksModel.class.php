<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/27
 * Time: 下午9:25
 */

namespace Home\Model;


use Think\Model\RelationModel;

class BooksModel extends RelationModel
{

    protected $_link = array(
        'Sections' => array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'Sections',
            'foreign_key'   => 'id',
            'mapping_name'  => 'sections',
        ),

    );

    protected $_auto = array(
        array('is_finished','1',1),
    );
}