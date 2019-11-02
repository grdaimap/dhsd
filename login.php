<?php
if (isset($_COOKIE["userno"])&&$_COOKIE["userty"]=="ano")
header("location:tree.php?start=0");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./m/g.png" />
    <link rel="bookmark" href="./m/g.png" />
    <link rel="stylesheet" href="./style.css">
    <title>匿名登入</title>
</head>

<body style="background:linen">

    <form method="post" action="logind.php">
        <h2>请输入口令</h2><br>
        <h4 style="color:lightcoral">完全匿名不能主动评论他人，可以回复，不能踩或举报</h4>
        <br><br>
        <input class="iform1" style="border:3px,solid" type="password" autocomplete="new-password" name="apsn" />
        <input class="iform2" type="submit" value="登入" /><br>
        <br>
        <br>
    </form>
    <form  method="post" action="dwsnup.php">
        <h4>没有口令?</h4>
        <input class="iform2" type="submit" value="注册" />
        <br>
        <br>
        <h4>或</h4>
        <input class="iform2" type="button" value="退出" onclick='location.href=("index.html")' />
    </form>


</body>



</html>