<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/5
 * Time: 下午3:41
 */

namespace Home\Controller;


use Think\Controller;

class BooksController extends Controller
{
    public function showsections()
    {
        $book_id = I('get.book_id', 'addslashes');
        //        echo $book_name;
        $Section = M('Sections');
        // 读取数据
        $data = $Section->where("book_id=1")->select();
        if ($data) {
            $this->assign('sections', $data);// 模板变量赋值
        } else {
            $this->error('数据错误');
        }
        $this->display();
    }

    public function showarticle()
    {
        $this->display();
    }
}