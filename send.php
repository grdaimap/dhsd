<?php
if (!isset($_COOKIE["userno"])or$_COOKIE["userno"]==NULL)
{
    header("location:index.html");
    die();
}
?>




<?php
header("Content-type: text/html; charset=utf-8");


if(empty($_POST["article"]))
{
    header("location:tree.php?start=0");die();
}


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

if($_COOKIE["userty"]=="sno"){
    /**
	 * 包含SDK
	 */
	require("./yiban/classes/yb-globals.inc.php");

	//配置文件
	require_once './yiban/demo/config.php';
	
	//初始化
    $api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);
    
    $au  = $api->getAuthorize();

    $sql1 = "SELECT zno FROM ztb order by zno DESC limit 1;";
    $result1 = $conn->query($sql1);
    $c=0;
    if($row1=$result1->fetch_assoc())
    {
    $c=$row1["zno"]+1;
    }
    $encode = mb_detect_encoding($_POST["article"], array("ASCII",'UTF-8',"GB2312","GBK",'BIG5')); 
    $str_encode = mb_convert_encoding($_POST["article"], 'UTF-8', $encode);

    $sql = sprintf("INSERT INTO ztb (zno, sno, context,createt,endt,good)
    VALUES ('%s', '%s', '%s','%s', '%s',0)",$c,$_COOKIE["userno"],$str_encode,time()+8*3600,time()+176*3600);

    if ($conn->query($sql) == TRUE) {
         
        echo "<!DOCTYPE html><html>";
        echo "<script language='javascript' type='text/javascript'>"; 
        echo "window.location.href='tree.php?start=0'"; 
        echo "</script></html>"; 
         
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
else
{
    $sql0 = 'SELECT * FROM atb where ano = "'.$_COOKIE["userno"].'" and apsn ="'.$_COOKIE["userpsn"].'"';

    $result0 = $conn->query($sql0);

    if($row=$result0->fetch_assoc())
    {
        $sql1 = "SELECT zno FROM ztb order by zno DESC limit 1;";
        $result1 = $conn->query($sql1);
        $c=0;
        if($row1=$result1->fetch_assoc())
        {
        $c=$row1["zno"]+1;
        }
        $encode = mb_detect_encoding($_POST["article"], array("ASCII",'UTF-8',"GB2312","GBK",'BIG5')); 
        $str_encode = mb_convert_encoding($_POST["article"], 'UTF-8', $encode);
        $sql = sprintf("INSERT INTO ztb (zno, ano, context,createt,endt,good)
        VALUES ('%s', '%s', '%s','%s', '%s',0)",$c,$_COOKIE["userno"],$str_encode,time()+8*3600,time()+176*3600);

        if ($conn->query($sql) == TRUE) {
            
            echo "<!DOCTYPE html><html>";
            echo "<script language='javascript' type='text/javascript'>"; 
            echo "window.location.href='tree.php?start=0'"; 
            echo "</script></html>"; 
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
    else
    {   
        setcookie("userno", NULL);
        setcookie("usernick", NULL);
        setcookie("userty", NULL);
        setcookie("userpsn", NULL);
        setcookie("lasttime", NULL);
        echo "<!DOCTYPE html><html><script>alert('身份校验失败，请重新登录')</script>";
        echo "<script language='javascript' type='text/javascript'>"; 
        echo "window.location.href='login.php'"; 
        echo "</script></html>"; 
    }
}






?>