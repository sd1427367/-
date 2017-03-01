<?php 
require __DIR__.'/function.base.php';
require  dirname(__DIR__).'/mysql.class.php';
$db=new Mysql(array());
$tit=$_GET['title'];
$time=$_GET['time'];
$sql="SELECT * FROM note WHERE title='$tit' AND `time`='$time'";
$res=$db->getOneRow($sql);
$id=$res['id'];
//判断是否POST请求
if (is_post()) {
	//获取用户名密码
	$title=isset($_POST['title'])?$_POST['title']:'';
	$content=isset($_POST['content'])?$_POST['content']:'';
	//匹配数据库
	$sql="UPDATE note set  title='$title',word='$content'  WHERE id=".$id.";";
	$rese=$db->exec($sql);
	if ($rese) {
		header('Location:admin_log.php');
	}else{
		echo "修改失败";
	}







}









include __DIR__.'/view/write_log.php-action=edit&gid=1.html';
