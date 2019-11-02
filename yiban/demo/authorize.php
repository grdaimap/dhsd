<?php
	/**
	 * 网站接入使用Auth认证接口进行授权
	 * 授权流程先通过浏览器重定向到授权服务器取得授权码（code）后
	 * 再从服务器使用接口调用获取到对应用户的访问令牌
	 * 
	 */
    

	/**
	 * 包含SDK
	 */
	require("../classes/yb-globals.inc.php");

	//配置文件
	require_once 'config.php';
	
	//初始化
	$api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);
	$au  = $api->getAuthorize();
	
	//网站接入获取access_token，未授权则跳转至授权页面
	$info = $au->getToken();
	if(!$info['status']) {//授权失败
	    echo $info['msg'];
	    die;
	}
	$token = $info['token'];//网站接入获取的token

	$api->bind($token);
	
?>
<html>
<body>
	<p><?php if (isset($token)&&$token){?>授权成功，点击下方链接查看通用接口测试<?php }?></p>
	<?php

	$row=$api->request('user/me')["info"];

	/*echo $row["yb_userid"];
	echo $row["yb_usernick"];
	echo $token;
	*/
	$servername = "localhost";
	$username = "root";
	$password = "your password";
	$dbname = "dhsd";
	
	// 创建连接
	$conn = new mysqli($servername, $username, $password, $dbname);
	// 检测连接
	if ($conn->connect_error) {
		die("连接失败: " . $conn->connect_error);
	}

	$sql = sprintf("INSERT INTO stb (sno, snick,endt)
	VALUES ('%s', '%s',0)",$row["yb_userid"],$row["yb_usernick"]);
	
	echo $sql;

	$result0=$conn->query($sql);

	print_r($result0);

	$sql1 = "select * from stb where sno =".$row["yb_userid"];
	
	$result1=$conn->query($sql1);

	echo $sql1;

	$row1=$result1->fetch_assoc();

	print_r($row1);

	setcookie("userno", $row1["sno"], time()+1200);
	setcookie("usernick", $row1["snick"], time()+1200);
	setcookie("userty", "sno", time()+1200);
	setcookie("userpsn", $token, time()+1200);
	setcookie("lasttime", $row1["endt"], time()+1200);
	

	$conn->close();

	echo $_COOKIE["userno"];

header("location:../../tree.php?start=0");
	?>
	
</body>
</html>