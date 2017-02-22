<?php 
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
		echo "登陆成功";
	}else{
		echo "登录失败";
	}
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
		<input type="submit" name="submit" value="登录">
	</form>
</body>
</html>