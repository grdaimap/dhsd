<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./m/g.png" />
    <link rel="bookmark" href="./m/g.png" />
    <link rel="stylesheet" href="style.css">
    <title>匿名注册</title>
</head>

<body style="background:linen">

<?php
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
$sql0 = "SELECT ano FROM atb order by ano DESC limit 1;";
$result0 = $conn->query($sql0);
$c=0;
if($row=$result0->fetch_assoc())
{
$c=($row["ano"]+1)%999999999;
}

$uniqid0=md5(uniqid(microtime(true),true));

$uniqid =substr($uniqid0,10,10);
$a=substr($uniqid0,20,10);
$b=$c.$uniqid;

$sql = sprintf("INSERT IGNORE INTO atb (ano, anick, apsn,endt)
VALUES ('%s', '%s', '%s',0)",$c,$a,$b);
 
if ($conn->query($sql) == TRUE) {
    echo "<h3>新记录插入成功</h3>\n<br>";
    echo "<p style=\"color:red;\">口令是匿名用户登录的唯一凭证，请妥善保存</p>\n<br>";
    echo "<input id=\"foo\" class=\"iform1\" type=\"text\" value=".$b." >\n<br>";
    echo "<button class=\"iform2\" data-clipboard-action=\"copy\" data-clipboard-target=\"#foo\">复制并返回</button>\n
    ";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
$conn->close();
?>


</body>

    <!-- 2. Include library -->
    <script src="clipboard.min.js"></script>

    <!-- 3. Instantiate clipboard -->
    <script>
    var clipboard = new ClipboardJS('.iform2');

    clipboard.on('success', function(e) {
        alert("复制成功");
        window.location.href="login.php";
    });

    clipboard.on('error', function(e) {
        alert("复制失败");
    });
    </script>

</html>