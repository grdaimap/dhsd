<?php
if (!isset($_COOKIE["userno"])or$_COOKIE["userno"]==NULL)
{
    header("location:index.html");
    die();
}
?>


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


$sql = 'INSERT INTO ktb (xno, zno,xty,zty) VALUES ("'.$_COOKIE["userno"].'",'.$_GET["zno"].',"'.$_COOKIE["userty"].'",1)';

echo $sql;

$result = $conn->query($sql);
//echo "000";
//echo $result;

if($result)
{    
    $sql0 = 'UPDATE ztb SET good = good + 1 where zno = '.$_GET["zno"];
    $sql2 = 'UPDATE ztb SET endt = endt + 3*3600 where zno = '.$_GET["zno"];
    $result0 = $conn->query($sql0);
    $result2 = $conn->query($sql2);
    if($result0&&$result2)
    echo $result0;
    echo $result2;
}
$conn->close();
//echo "111";
  // header("location:tree.php?start=0");
  $referer = $_SERVER['HTTP_REFERER']; //来路信息。就是上一页
  header("Location: $referer"); //浏览器跳转
?>