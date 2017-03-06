<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/28
 * Time: 上午12:35
 */

namespace Admin\Controller;


use Think\Controller;

class AffichesController extends Controller
{
    public function affichesList()
    {
        if (session('user_name') != 'admin') {
            redirect(U('Login/loginShow'));
        }
        $pa = I('get.p',0,'intval');
        $Affiches = M('Affiches');
//        $data = M('Affiches a')->select();
        $data = $Affiches->order('created_at desc')
            ->page($pa.',5')->select();
        $count = $Affiches->count();
        $Page = new \Think\Page($count,5);
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('affiches',$data);
        $this->display();
    }

    public function delAffiches()
    {
        $id = I('get.id',0,'intval');
        if (!$id) {
            $this->error('公告id为空');
        }
        $this->assign('user_name',session('user_name'));
        $Affiches = M('Affiches');
        $Affiches->where("id = $id")->delete();
        $this->success('删除成功');
    }

    public function updateAffiches()
    {
        if (session('user_name') != 'admin') {
            redirect(U('Login/loginShow'));
        }
        $this->assign('user_name',session('user_name'));
        $id = I('get.id',0,'intval');
        if ( !$id ) {
            $this->error('无效的公告号!');
        }
        $affiches = M('Affiches');
        $affiche = $affiches->find($id);
        $this->assign('affiche',$affiche);
        $this->display();
    }

    public function saveAffiches()
    {
        if (session('user_name') != 'admin') {
            redirect(U('Login/loginShow'));
        }
        $this->assign('user_name',session('user_name'));
        if (IS_POST) {
            $id = I('post.id',0,'intval');
            $contents = I('post.contents','','addslashes');
            $affichces = M('Affiches');
            if ($id) {
//                $affichces = M('Affiches');
                if ($contents) {
                    $affichces->contents = $contents;
                }
                $affichces->where("id = $id")->save();
                $this->success('更新成功');
            } else {
                if (!$data = $affichces->create()) {
                    $affichces->getError();
                }else{
                    $affichces->add($data);
                    $this->success('创建成功');
                }

            }
        }
    }

    public function affichesNew()
    {
        if (session('user_name') != 'admin') {
            redirect(U('Login/loginShow'));
        }
        $this->assign('user_name',session('user_name'));
        $this->display();
    }
}