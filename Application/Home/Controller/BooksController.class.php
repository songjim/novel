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
    public function showsections($b_id='')
    {
        $book_id = I('get.book_id', 'addslashes');
        //        echo $book_name;
        $Section = M('Sections');
        $Book = M('Books');
        $Categries = M('Categories');
        $categorys = $Categries->select();
        $this->assign('categories', $categorys);
        $book = $Book->where("id = $book_id")->find();
        // 读取数据
        $data = $Section->where("book_id=$book_id")->select();
        $this->assign('book',$book);
        if ($data) {
            $this->assign('sections', $data);// 模板变量赋值
        }
        $this->display();
    }

    public function showarticle()
    {
        $section_id = I('get.section_id', 'addslashes');
        $book_id = I('get.book_id','addslashes');
        $taxis = I('get.taxis_id',0,'intval');
        var_dump($taxis);
        $Article = D('Articles');
        $Categries = M('Categories');
        $categorys = $Categries->select();
        $this->assign('categories', $categorys);
        if ($taxis == 0) {
            $data = $Article->join('sections on sections.id = articles.sections_id')
                ->join('books on books.id = sections.book_id')
                ->join('categories on books.category_id = categories.id')
                ->where("articles.sections_id=$section_id and books.id = $book_id")
                ->field('sections.name as section_name,sections.book_id,books.*,categories.*,articles.*,sections.id as section_id,sections.taxis as section_taxis')
                ->find();
        }else{
            $data = $Article->join('sections on sections.id = articles.sections_id')
                ->join('books on books.id = sections.book_id')
                ->join('categories on books.category_id = categories.id')
                ->where("sections.taxis=$taxis and books.id = $book_id")
                ->field('sections.name as section_name,sections.book_id,books.*,categories.*,articles.*,sections.id as section_id,sections.taxis as section_taxis')
                ->find();
        }

        $up_article = M('Sections')->where("book_id = $book_id")->order('id desc')->field('name')->find();
        if ($data) {
            $this->assign('article', $data);// 模板变量赋值
            $create_time = date('Y.m.d',strtotime($data['created_at']));
            $up_time = date('Y.m.d H:i:s',strtotime($data['updated_at']));
            $this->assign('up_article',$up_article);
            $this->assign('up_time',$up_time);
            $this->assign('create_time',$create_time);
            $this->display();
        } else {
            $this->error('已经是最新的了');

        }

    }
}