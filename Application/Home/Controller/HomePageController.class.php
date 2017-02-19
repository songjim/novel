<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/5
 * Time: 下午1:42
 */

namespace Home\Controller;

use Think\Controller;

class HomePageController extends Controller
{
    public function homeshow()
    {
        if ($_SESSION['user_name'] != '') {
            $this->assign('user_name',$_SESSION['user_name']);
        }
        $Categries = M('Categories');
        $data = $Categries->select();
        $this->assign('categories',$data);
        $books = M('Books')->join('categories c on c.id = books.category_id')->order('books.updated_at desc')
            ->field('books.*,c.name as category_name,c.description as category_description')->select();
        $this->assign('books',$books);
        $this->display();
    }

    public function categoryshow()
    {
        if ($_SESSION['user_name'] != '') {
            $this->assign('user_name',$_SESSION['user_name']);
        }
        $Categries = M('Categories');
        $data = $Categries->select();

//        $book_id = I('get.book_id', 'addslashes');
        $category_id = I('get.category_id','0','addslashes');
        $Book = M('Books');
        $book_datas = $Book->where("category_id = $category_id")->order('is_recommend desc')->select();
        $cate = $Categries->where("id = $category_id")->find();
        $recommend = array();
        $un_recommend = array();
        foreach ($book_datas as $book_data) {
            if ($book_data['is_recommend'] == 1)
            {
                $recommend[] = $book_data;
            }else{
                $un_recommend[] = $book_data;
            }
        }
        $this->assign('categories',$data);
        $this->assign('current_category',$cate);
        $this->assign('recommends',$recommend);
        $this->assign('all_book',$book_datas);
        $this->display();
    }

    public function forumshow()
    {
//        $User = M('User'); // 实例化User对象
//        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
//        $list = $User->where('status=1')->order('create_time')->page($_GET['p'].',25')->select();
//        $this->assign('list',$list);// 赋值数据集
//        $count      = $User->where('status=1')->count();// 查询满足要求的总记录数
//        $Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数
//        $show       = $Page->show();// 分页显示输出
//        $this->assign('page',$show);// 赋值分页输出
//        $this->display(); // 输出模板
//



        if ($_SESSION['user_name'] != '') {
            $this->assign('user_name',$_SESSION['user_name']);
        }
        $category_id = I('get.category_id',0,'addslashes');
        $where = array();
        if ($category_id != 0) {
            $where['forums.category_id'] = $category_id;
        }
        $forums = M('Forums');
        $current_category = $forums->join("users u on u.id = forums.user_id")
            ->join("categories c on c.id = forums.category_id")
            ->where($where)->order('forums.updated_at desc')
            ->field('u.user_name,c.name as category_name,forums.*')->page($_GET['p'].',5')->select();
        $this->assign('current_categories',$current_category);
        $count = $forums->where($where)->count();
        $Page = new \Think\Page($count,5);
        $show = $Page->show();
        $this->assign('page',$show);
        $Categries = M('Categories');
        $data = $Categries->select();
        $this->assign('categories',$data);
        $this->display();
    }

    public function personalShow()
    {
        if ($_SESSION['user_name'] == '') {
            redirect(U('HomePage/homeshow'));
        } else {
            $this->assign('user_name', $_SESSION['user_name']);
        }
        $Categries = M('Categories');
        $data = $Categries->select();
        $this->assign('categories', $data);
        $user_id = session('user_id');
        $forums = M('Forums')->join("categories c on c.id = forums.category_id")
            ->where("user_id = $user_id")->field('c.name as category_name,forums.*')->select();
        var_dump($forums);
        $this->assign('forums_count',count($forums));
        $this->assign('forums',$forums);
        $this->display();
    }

}