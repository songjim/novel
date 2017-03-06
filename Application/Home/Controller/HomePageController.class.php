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
        $Affiches = M('Affiches');
        $affiches = $Affiches->order('created_at desc')->select();
        $this->assign('affiches',$affiches);
        $new_book = M('Books')->order('created_at desc')->limit(4)->select();
        $this->assign('new_book',$new_book);
        $books = M('Books')->join('categories c on c.id = books.category_id')->order('books.updated_at desc')
            ->field('books.*,c.name as category_name,c.description as category_description')->select();
        $this->assign('books',$books);
        $replays = M('Replays')->join('forums f on f.id = replays.forum_id')->join('categories c on c.id = f.category_id')->order('created_at desc')->field('c.name as c_name,replays.*')->limit(6)->select();
        $this->assign('replays',$replays);
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
        if ($_SESSION['user_name'] != '') {
            $this->assign('user_name',$_SESSION['user_name']);
        }
        $category_id = I('get.category_id',0,'addslashes');
        $where = array();
        if ($category_id != 0) {
            $where['forums.category_id'] = $category_id;
        }

        $p_s = I('get.p',1,'intval');
        $forums = M('Forums');
        $current_category = $forums->join("users u on u.id = forums.user_id")
            ->join("categories c on c.id = forums.category_id")
            ->where($where)->order('forums.updated_at desc')
            ->field('u.user_name,c.name as category_name,forums.*')->page($p_s.',5')->select();
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
            $id = session('user_id');
        }
        $Categries = M('Categories');
        $data = $Categries->select();
        $this->assign('categories', $data);
        $user_id = session('user_id');
        $forums = M('Forums')->join("categories c on c.id = forums.category_id")
            ->where("user_id = $user_id")->field('c.name as category_name,forums.*')->select();
        $this->assign('forums_count',count($forums));
        $this->assign('forums',$forums);
        $user = M('Users')->find($id);
        $this->assign('user',$user);
        $replays = M('Forums f')->join("replays r on r.forum_id = f.id")
            ->join('categories c on f.category_id = c.id')
            ->join('users u on u.id = r.user_id')
            ->where("f.id in (select id from forums where user_id = {$_SESSION['user_id']}) and r.user_id <> {$_SESSION['user_id']}")
            ->order('r.created_at desc')
            ->field('r.*,f.name,u.user_name,c.name as c_name')
            ->select();
        $replays_r = M('Replays r')->join('forums f on f.id = r.forum_id')
            ->join('categories c on f.category_id = c.id')
            ->join('users u on u.id = r.user_id')
            ->order('r.created_at desc')
            ->where("r.replay_id in (select id from replays where user_id = {$_SESSION['user_id']}) and r.user_id <> {$_SESSION['user_id']}")
            ->field('r.*,c.name as c_name,f.name,u.user_name')->select();
        $replays_data = array_merge($replays,$replays_r);
        $this->assign('replays_count',count($replays_data));
        $this->assign('replays_data',$replays_data);
        $this->display();
    }

}