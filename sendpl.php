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
    header("location:pinlun.php?zno=".$_POST["zno"]);die();
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

    $sql1 = "SELECT cno FROM ctb order by cno DESC limit 1;";
    $result1 = $conn->query($sql1);
    $c=0;
    if($row1=$result1->fetch_assoc())
    {
    $c=$row1["cno"]+1;
    }
    $encode = mb_detect_encoding($_POST["article"], array("ASCII",'UTF-8',"GB2312","GBK",'BIG5')); 
    $str_encode = mb_convert_encoding($_POST["article"], 'UTF-8', $encode);

    $jiamin=$_COOKIE["usernick"];
    if($_POST["name"]==$_COOKIE["userno"])$jiamin="帖主";

    $sql = sprintf("INSERT INTO ctb (cno, zno,fromwho, fnick, towho,tnick, context,createt)
    VALUES ('%s', '%s', '%s','%s', '%s', '%s','%s', '%s')",$c,$_POST["zno"],$_COOKIE["userno"],$jiamin,$_POST["towho"],$_POST["tnick"],$str_encode,time()+8*3600);

    if ($conn->query($sql) == TRUE) {
        echo "<!DOCTYPE html><html>";
        echo "<script language='javascript' type='text/javascript'>"; 
        echo "window.location.href='pinlun.php?zno=".$_POST["zno"]."'"; 
        echo "</script></html>"; 
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
else
{
    // $sql3 = 'SELECT ano FROM ztb where zno = '.$_POST["zno"];

    // $result3 = $conn->query($sql3);

    // $row3=$result3->fetch_assoc();

    // if($row3["ano"]!=$_COOKIE["userno"])
    // {
    //     echo "<!DOCTYPE html><html><script>alert('权限不足')</script>";
    //     echo "<script language='javascript' type='text/javascript'>"; 
    //     echo "window.location.href='pinlun.php?zno=".$_POST["zno"]."'"; 
    //     echo "</script></html>"; 
    // }

    $sql0 = 'SELECT * FROM atb where ano = "'.$_COOKIE["userno"].'" and apsn ="'.$_COOKIE["userpsn"].'"';

    $result0 = $conn->query($sql0);

    if($row=$result0->fetch_assoc())
    {
        $sql1 = "SELECT cno FROM ctb order by cno DESC limit 1;";
        $result1 = $conn->query($sql1);
        $c=0;
        if($row1=$result1->fetch_assoc())
        {
        $c=$row1["cno"]+1;
        }
        $encode = mb_detect_encoding($_POST["article"], array("ASCII",'UTF-8',"GB2312","GBK",'BIG5')); 
        $str_encode = mb_convert_encoding($_POST["article"], 'UTF-8', $encode);
        $sql = sprintf("INSERT INTO ctb (cno, zno,fromwho, fnick, towho,tnick, context,createt)
        VALUES ('%s', '%s', '%s','%s', '%s', '%s','%s', '%s')",$c,$_POST["zno"],$_COOKIE["userno"],"帖主",$_POST["towho"],$_POST["tnick"],$str_encode,time()+8*3600);

        if ($conn->query($sql) == TRUE) {
            echo "<!DOCTYPE html><html>";
            echo "<script language='javascript' type='text/javascript'>"; 
            echo "window.location.href='pinlun.php?zno=".$_POST["zno"]."'"; 
            echo "</script></html>"; 
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
    else
    {   
        setcookie("userno", NULL);
        setcookie("userty", NULL);
        setcookie("userpsn", NULL);
        echo "<!DOCTYPE html><html><script>alert('身份校验失败，请重新登录')</script>";
        echo "<script language='javascript' type='text/javascript'>"; 
        echo "window.location.href='login.php'"; 
        echo "</script></html>"; 
    }
}






?>