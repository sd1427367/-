<?php 
require __DIR__.'/function.base.php';
//判断是否POST请求
if (is_post()) {
	require  dirname(__DIR__).'/mysql.class.php';
	$db=new Mysql(array());
	//获取用户名密码
	$title=isset($_POST['title'])?$_POST['title']:'';
	$content=isset($_POST['content'])?$_POST['content']:'';
	//匹配数据库
	$sql="INSERT INTO note (title,word) VALUES ('$title','$content');";
	$res=$db->exec($sql);
	if ($res) {
		header('Location:admin_log.php');
	}else{
		echo "插入失败";
	}







}














include __DIR__.'/view/write_log.html';
