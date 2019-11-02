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

if($_COOKIE["userty"]=="sno")
{
    $sql = 'UPDATE stb SET snick = "'.(substr($_POST["newnick"],0,20)).'" where sno = "'.$_COOKIE["userno"].'"';
    echo $sql;
    $result = $conn->query($sql);
    echo $result;
    if(!$result)echo "<script>alert('失败')</script>";
    else setcookie("usernick",substr($_POST["newnick"],0,20),time()+1200);
}
else
{
    $sql = 'UPDATE atb SET anick = "'.(substr($_POST["newnick"],0,20)).'" where ano = '.$_COOKIE["userno"];
    echo $sql;
    $result = $conn->query($sql);
    if(!$result)echo "<script>alert('失败')</script>";
    else setcookie("usernick",substr($_POST["newnick"],0,20),time()+1200);
}
header("location:info.php");

?>