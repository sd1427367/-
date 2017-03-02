<?php 
include __DIR__.'/inc.php';
require __DIR__.'/function.base.php';
$action=isset($_GET['action'])?$_GET['action']:'';
switch ($action) {
	case 'edit':
		$id=isset($_REQUEST['id'])&&is_numeric($_REQUEST['id'])?intval($_REQUEST['id']):0;
		if (is_post()) {
			require  dirname(__DIR__).'/mysql.class.php';
			$db=new Mysql(array());
			//获取网页上传的数据
			$title=isset($_POST['title'])?$_POST['title']:'';
			$content=isset($_POST['content'])?$_POST['content']:'';
			//修改数据
			$sql="UPDATE note set  title='$title',word='$content'  WHERE id=".$id.";";
			$rese=$db->exec($sql);
			if ($rese) {
				header('Location:admin_log.php');
			}else{
				echo "修改失败";
			}
		}else{
			require  dirname(__DIR__).'/mysql.class.php';
			$db=new Mysql(array());
			//通过GET获取数据匹配查询信息
			$sql="SELECT * FROM note WHERE id='$id'";
			$res=$db->getOneRow($sql);
			$id=$res['id'];
		}
		include __DIR__.'/view/write_edit.html';
		break;
	
	default:
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
		break;
}

