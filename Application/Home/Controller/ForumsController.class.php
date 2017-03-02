<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/2/12
 * Time: 下午5:05
 */

namespace Home\Controller;


use Think\Controller;

class ForumsController extends Controller
{
    public function detailshow()
    {
        if ($_SESSION['user_name'] != '') {
            $this->assign('user_name', $_SESSION['user_name']);
        }
        $is_read = I('get.read',0,'addslashes');
        $replay_id = I('get.replay_id',0,'addslashes');
        if ($is_read == 1) {
            $replay = M('Replays');
            $replay->is_read = 1;
            $replay->where("id = $replay_id")->save();
        }
        $Categries = M('Categories');
        $data = $Categries->select();
        $this->assign('categories', $data);
        $forum_id = I('get.forum_id', 0, 'addslashes');
        if ($forum_id == 0) {
            $this->error('无效的帖子ID');
        }
        $forum = M('Forums')->join('categories c on c.id = forums.category_id')
            ->join('users u on u.id = forums.user_id')
            ->where("forums.id = $forum_id")
            ->field("forums.*,c.name as category_name,u.user_name,u.user_img")
            ->find();
        $this->assign('forum', $forum);
        $replays = M('Replays')->join('users u on u.id = replays.user_id')
            ->where("replays.forum_id = $forum_id and replays.replay_id = 0")
            ->field("u.user_name,u.user_img,replays.*")
            ->order("replays.created_at asc ")
            ->select();
        $child_replay = M('Replays')->join('users u on u.id = replays.user_id')
            ->where("replays.forum_id = $forum_id and replays.replay_id <>0 ")
            ->field("u.user_name,u.user_img,replays.*")
            ->order("replays.created_at asc ")
            ->select();
        foreach ($replays as $k => $v) {
            foreach ($child_replay as $key => $value) {
                if ($v['id'] == $value['replay_id']) {
                    $replays[$k]['children'][] = $value;
                }
            }
        }
        $this->assign('replays', $replays);
        $this->display();
    }

    public function replayShow()
    {
        if ($_SESSION['user_name'] == '') {
            redirect(U('HomePage/homeshow'));
        } else {
            $this->assign('user_name', $_SESSION['user_name']);
        }
        $Categries = M('Categories');
        $data = $Categries->select();
        $this->assign('categories', $data);
//        $category_id = I('get.category_id',0,'addslashes');
//        $category_name = $Categries->field('name')->find($category_id);
        $forum_id = I('get.forum_id',0,'addslashes');
        $forum = M('Forums')->join('categories c on c.id = forums.category_id')
            ->where("forums.id = $forum_id")
            ->field('c.id as category_id,forums.id as forum_id,c.name as category_name,forums.name as forum_name')
            ->find();
        $replay_id = I('get.replay_id',0,'addslashes');
        $replay = M('Replays')->find($replay_id);
        $this->assign('replay',$replay);
        $this->assign('forum',$forum);
        $this->display();
    }

    public function editForums()
    {
        if ($_SESSION['user_name'] == '') {
            redirect(U('HomePage/homeshow'));
        }

        if (IS_POST) {
            $forums = D('Forums');
            if (!$data = $forums->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($forums->getError());
            }
            if ($id = $forums->add($data)) {
                redirect(U('Forums/detailshow', array('forum_id' => $id)));
            } else {
                exit($forums->getError());
            }
        }
    }

    public function editReplays()
    {
        if ($_SESSION['user_name'] == '') {
            redirect(U('HomePage/homeshow'));
        }
        if (IS_POST) {
            $replays = D('Replays');
            if (!$data = $replays->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($replays->getError());
            }
            $forum_id = I('post.forum_id', 0, 'addslashes');
            if (!$forum_id) {
                $this->error('帖子id为空');
            }
            if ($id = $replays->add($data)) {
                $forums = M('Forums');
                $forums->updated_at = $replays->created_at;
                $forums->where("id = $forum_id")->save();
                redirect(U('Forums/detailshow', array('forum_id' => $forum_id)));
            } else {
                exit($replays->getError());
            }
        }
    }

    public function messageNum()
    {
        if ($_SESSION['user_name'] == '') {
            redirect(U('HomePage/homeshow'));
        }
        $replays = M('Forums f')->join("replays r on r.forum_id = f.id")
            ->join('categories c on f.category_id = c.id')
            ->join('users u on u.id = r.user_id')
            ->where("f.id in (select id from forums where user_id = {$_SESSION['user_id']}) and r.user_id <> {$_SESSION['user_id']} and r.is_read = 0")
            ->field('r.*,f.name,u.user_name,c.name as c_name')
            ->select();
        $replays_r = M('Replays r')->join('forums f on f.id = r.forum_id')
            ->join('categories c on f.category_id = c.id')
            ->join('users u on u.id = r.user_id')
            ->where("r.replay_id in (select id from replays where user_id = {$_SESSION['user_id']}) and r.user_id <> {$_SESSION['user_id']} and r.is_read = 0")
            ->field('r.*,c.name as c_name,f.name,u.user_name')->select();
        $replays_data = array_merge($replays,$replays_r);
        $massage_num = count($replays_data);
        echo json_encode(array('success'=>true,'msg'=>'','data'=>array('count'=>$massage_num)));
        exit();
    }
}