<?php
if (!isset($_COOKIE["userno"])or$_COOKIE["userno"]==NULL)
{
    header("location:index.html");
    die();
}
?>

<?php 

if($_COOKIE["userty"]=="sno")
{
     /**
	 * 包含SDK
	 */
	require("./yiban/classes/yb-globals.inc.php");

	//配置文件
	require_once './yiban/demo/config.php';
	
	//初始化
    $api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);
    
    $au  = $api->getAuthorize();
    //echo "<script>confirm('确定举报吗？')</script>";
    $servername = "localhost";
    $username = "root";
    $password = "your password";
    $dbname = "dhsd";
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // 检测连接
    if ($conn->connect_error) 
    {
        die("连接失败: " . $conn->connect_error);
    }

    $sql = 'INSERT INTO ktb (xno, zno,xty,zty) VALUES ("'.$_COOKIE["userno"].'",'.$_GET["zno"].',"'.$_COOKIE["userty"].'",4)';

    $result = $conn->query($sql);

    if($result)
    {    
        $sql0 = 'UPDATE ztb SET endt = endt - 80*3600 where zno = '.$_GET["zno"];

        $result0 = $conn->query($sql0);
        
    }
}
else{       
    echo "<script>alert('匿名没有举报的权限')</script>";
 
}


// echo "<script language='javascript' type='text/javascript'>"; 
// echo "window.location.href='tree.php?start=0'"; 
// echo "</script>";
$referer = $_SERVER['HTTP_REFERER']; //来路信息。就是上一页
header("Location: $referer"); //浏览器跳转
?>