<?php
/**
 * Created by PhpStorm.
 * User: songjian
 * Date: 17/3/7
 * Time: 下午10:29
 */
require '/var/www/MyTp/ThinkPHP/Library/Think/Cache/Driver/Redis.class.php';
require_once dirname(__FILE__).'/../../ThixnkPHP/Library/Think/Cache/Driver/Redis.class.php';
//namespace Home\Controller;
///var/www/MyTp/ThinkPHP/Library/Think/Cache/Driver/Redis.class.php

//use Think\Controller;
//$redis = new Redis();
echo 1;
var_dump($redis);
$redis->connect('127.0.0.1');
//$redis->set('test','hello world!');
//echo $redis->get("test");
//$set = array(
//    'type' =>'redis' ,
//    'host'=>'127.0.0.1' ,
//    'port'=>6379,
//);
// 实例化
//$redis=S($set);
$a = $redis->get('song');
var_dump($redis);
//$a = 'song';
//$redis->$a = 'aaaa';