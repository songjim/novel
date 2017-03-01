<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/25
 * Time: 下午3:53
 */

namespace Admin\Controller;


use Think\Controller;

class NovelController extends Controller
{
    public function novelAdminShow()
    {
        $books = M('Books')->select();
//        var_dump($books);
        $this->assign('books',$books);
        $this->display();
    }

    public function novelNew()
    {
        $categorys = M('Categories')->select();
        $this->assign('categories',$categorys);
        $this->display();
    }

    public function novelList()
    {
        $books = M('Books b');
        $book = $books->join("left join categories c on c.id = b.category_id")
            ->field("c.id as c_id,c.name as c_name,b.*")->order('b.created_at desc')
            ->page($_GET['p'].',5')->select();
        $count = $books->count();
        $Page = new \Think\Page($count,5);
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('books',$book);
        $this->display('Novel/novelList');
    }

    public function novelUpdate()
    {
        $book_id = I('get.id',0,'intval');
        if (!$book_id) {
            $this->error('没有需要更新的小说');
        }
        $book = M('Books')->find($book_id);
        $this->assign('book',$book);
        $categorys = M('Categories')->select();
        $this->assign('categories',$categorys);
        $this->display();
    }

    public function novelDel($id = 0)
    {
        if ($id == 0) {
            echo json_encode(array('success'=>false,'msg'=> "无效的参数"));
            exit();
        }
        $books = M('Books');
        $books->find($id);
        $books->delete();
        return $this->novelList();
    }

    public function save()
    {
        if (IS_POST) {
            // 实例化Login对象
            $books = D('Home/Sections');
            $book_id = I('post.book_id',0,'addslashes');
            if (!$data = $books->create()) {
                header("Content-type: text/html; charset=utf-8");
                exit($books->getError());
            }
            $taxi = $books->field('taxis')->where("book_id = '$book_id'")->order('id desc')->find();
            $data['taxis'] = $taxi['taxis'];
            if ($id = $books->add($data)) {
                $article = M('Articles');
                $data2 = M('Articles')->create();
                $data2['sections_id'] = $id;
                $article->add($data2);
                exit(json_encode(array('success'=>true,'msg'=>'')));
            } else {
                exit($books->getError());
            }
        }
    }

    public function saveBook()
    {
        if (IS_POST) {
            $book = D('Books');
            $id = I('post.book_id',0,'intval');
            if ($id) {
//                $data = $book->find($id); // 根据条件更新记录
                if (!empty($_REQUEST['book_name'])) {
                    $book->book_name = $_REQUEST['book_name'];
                }
                if (!empty($_REQUEST['author'])) {
                    $book->author = $_REQUEST['author'];
                }
                if (!empty($_REQUEST['description'])) {
                    $book->description = $_REQUEST['description'];
                }
                $book->category_id = $_REQUEST['category_id'];
                if($book->where("id=$id")->save()){
                    $this->success('更新成功');
                }

            }else{
                if (!$data = $book->create()) {
                    exit($book->getError());
                }
                $img_name = uniqid();
//                $info = $this->nUpload($img_name);
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =     './book_img/'; // 设置附件上传根目录
                $upload->subName   =    '';
                $upload->saveName = $img_name;
                //            $upload->savePath  =     '/book_img/'; // 设置附件上传（子）目录
                // 上传文件l
                $info   =   $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                }else{// 上传成功
                    //                var_dump($info);
                    //                die();
                    $data['book_img'] = 'book_img/' . $info['book_img']['savename'];
                    $book->add($data);

                    $this->success('上传成功！');
                }
            }



        }
    }

    public function nUpload($img_name = '')
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './book_img/'; // 设置附件上传根目录
        $upload->subName   =    '';
        $upload->saveName = $img_name;
        //            $upload->savePath  =     '/book_img/'; // 设置附件上传（子）目录
        // 上传文件l
        $info   =   $upload->upload();
        return $info;
    }
}