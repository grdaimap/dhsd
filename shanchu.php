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
    //$sql = 'DELETE FROM ztb where sno = '.$_COOKIE["userno"].' and createt > '.(time()+8*3600-$_POST["past"]);$result==0||$result==0||
    //$result = $conn->query($sql);
    $sql2 = 'DELETE FROM ctb where fromwho = "'.$_COOKIE["userno"].'" and createt > '.(time()+8*3600-$_POST["past"]);
    $result2 = $conn->query($sql2);
    //echo $sql;
    //echo $sql2;

    if($result2==0)echo "<script>alert('失败');</script>";
    else echo "<script>alert('成功');</script>";
}
else
{
    //$sql = 'DELETE FROM ztb where ano = '.$_COOKIE["userno"].' and createt > '.(time()+8*3600-$_POST["past"]);
    //$result = $conn->query($sql);
    $sql2 = 'DELETE FROM ctb where fromwho = '.$_COOKIE["userno"].' and createt > '.(time()+8*3600-$_POST["past"]);
    $result2 = $conn->query($sql2);

    if($result2==0)echo "<script>alert('失败');</script>";
    else echo "<script>alert('成功');</script>";
}

echo "<script language='javascript' type='text/javascript'>"; 
echo "window.location.href='info.php'"; 
echo "</script>";

?>