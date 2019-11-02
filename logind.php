<?php 

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

$sql0 = 'SELECT * FROM atb where apsn = "'.$_POST["apsn"].'"';

$result0 = $conn->query($sql0);

if($row=$result0->fetch_assoc())
{
    setcookie("userno", $row["ano"], time()+1200);
    setcookie("usernick", $row["anick"], time()+1200);
    setcookie("userty", "ano", time()+1200);
    setcookie("userpsn", $row["apsn"], time()+1200);
    setcookie("lasttime", $row["endt"], time()+1200);
    header("location:tree.php?start=0");
}
else
{
    echo "<!DOCTYPE html><html><script>alert('用户不存在，请注册')</script>";
    echo "<script language='javascript' type='text/javascript'>"; 
    echo "window.location.href='login.php'"; 
    echo "</script></html>"; 
}

?>