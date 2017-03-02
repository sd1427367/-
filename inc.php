<?php 
session_start();
if (!isset($_SESSION['info'])) {
 	require __DIR__.'/function.base.php';
 	if (isset($_SESSION['info'])&&isset($_COOKIE['uid'])&&isset($_COOKIE['pass'])) {
 		require dirname(__DIR__).'/mysql.class.php';
 		$db=new Mysql(array());
 		$uid=$_COOKIE['uid'];
 		$pass=$_COOKIE['pass'];
 		$sql="SELECT * FROM userLogin WHERE user_id='$uid' AND user_pass='$pass'";
 		$res=$db->getOneRow($sql);
 		if ($res) {
 			$_SESSION['info']=$res;
 			echo "登陆成功";
				header('refresh:0;');
 		}
 	}else{
	//判断是否POST请求
 		if (is_post()) {
 			if ((strtoupper($_POST['imgcode'])==strtoupper($_SESSION['captcha']))) {
 				require  dirname(__DIR__).'/mysql.class.php';
 				$db=new Mysql(array());
			//获取用户名密码
 				$m_user=isset($_POST['user'])?$_POST['user']:'';
 				$m_pass=isset($_POST['pass'])?$_POST['pass']:'';
			//匹配数据库
 				$sql="SELECT * FROM userLogin WHERE user_name='$m_user' AND user_pass='$m_pass'";
 				$res=$db->getOneRow($sql);
 				$_SESSION['info']=$res;
			//判断用户名密码
 				if ($res) {
			//判断是否自动登录
 					if (isset($_POST['ispersis'])) {
 						setcookie('uid',$res['user_id'],time()+3600);
 						setcookie('pass',$res['user_pass'],time()+3600);
 					}else{
 						echo "登陆成功";
				header('refresh:0;');
 					}

 				}else{
 					echo "登录失败,账号或密码错误";
 				}
 			}else{
 				echo "验证码错误";
 			}
 		}
 	}

 	if (isset($_GET['act'])&&$_GET['act']=='logout') {
 		session_destroy();
 		setcookie('uid','',time()-1);
 		setcookie('pass','',time()-1);
 		echo "登陆成功";
				header('refresh:0;');
 	}
include __DIR__.'/view/login.html';
 	die();
} 






