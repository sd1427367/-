<?php 
require  dirname(__DIR__).'/mysql.class.php';
$db=new Mysql(array());
//获取用户名密码
$sql='SELECT `title`,`time` FROM `note`;';
$res=$db->getAllRows($sql);
$count=count($res);













include __DIR__.'/view/admin_log.html';