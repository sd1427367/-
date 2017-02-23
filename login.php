<?php 
session_start();
if (isset($_SESSION['info'])&&isset($_COOKIE['uid'])&&isset($_COOKIE['pass'])) {
		require '../mysql.class.php';
		$db=new Mysql(array());
		$uid=$_COOKIE['uid'];
		$pass=$_COOKIE['pass'];
		$sql="SELECT * FROM userLogin WHERE user_id='$uid' AND user_pass='$pass'";
		$res=$db->getOneRow($sql);
		if ($res) {
			$_SESSION['info']=$res;
			echo "自动登陆成功<a href='?act=logout' >安全退出</a>";
		}
}else{
	function is_post(){
		return (isset($_SERVER['REQUEST_METHOD'])&&$_SERVER['REQUEST_METHOD']==='POST');
	}
	//判断是否POST请求
	if (is_post()) {
		require '../Mysql.class.php';
		$db=new Mysql(array());
		//获取用户名密码
		$m_user=isset($_POST['user'])?$_POST['user']:'';
		$m_pass=isset($_POST['pass'])?$_POST['pass']:'';
		//匹配数据库
		$sql="SELECT * FROM userLogin WHERE user_name='$m_user' AND user_pass='$m_pass'";
		$res=$db->getOneRow($sql);
		//判断用户名密码
		if ($res) {
		//判断是否自动登录
			if (isset($_POST['remember'])) {
				$_SESSION['info']=$res;
				setcookie('uid',$res['user_id'],time()+3600);
				setcookie('pass',$res['user_pass'],time()+3600);
				echo "自动登陆成功<a href='?act=logout' >安全退出</a>";
			}else{
				echo "登陆成功";
			}
			
		}else{
			echo "登录失败";
		}
	}
}

if (isset($_GET['act'])&&$_GET['act']=='logout') {
		session_destroy();
		setcookie('uid','',time()-1);
		setcookie('pass','',time()-1);
		header('Location:login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src='login.js'></script>
	<meta charset="utf-8">
	<title>登录</title>
	<link rel="stylesheet" type="text/php" href="./login.php">
</head>
<body>
	<p>请输入账号密码</p>
	<form method="post" action="login.php">
		账号：<input type="text" name="user">
		<br>
		密码：<input type="password" name="pass">
		<br>
		自动登录：<input type="checkbox" name="remember" >
		<br>
		<input type="submit" name="submit" value="登录">
	</form>
</body>
</html>