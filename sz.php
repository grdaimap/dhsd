<?php
if (!isset($_COOKIE["userno"])or$_COOKIE["userno"]==NULL)
{
    header("location:index.html");
    die();
}
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
    <title>设置</title>
</head>

<body style="background:rgb(215, 231, 231)" >
<h4>个人信息</h4>
    <form style="text-align:center;margin: 10px" action="xg.php" method="post" >

        昵称：<input class="dbi" id="newnick" name="newnick" type="text" value="<?php echo $_COOKIE["usernick"]; ?>" /><br><br>
        <input class="dbn" type="submit" value="修改" style="color:darksalmon;font-style:inherit"  onclick="" />
        <input class="dbn" type="button" value="返回" style="color:darkcyan" onclick='location.href=("info.php")' />
    </form>
<h4>实验室</h4>
    <form style="text-align:center;margin: 10px" action="shanchu.php" method="post" >
    删除过去 <input class="dbi" id="past" name="past" type="text" value="0"/>秒我发送的评论<br><br>
    <input class="dbn" type="submit" value="确认" style="color:darksalmon;font-style:inherit"  onclick="" />
    </form>


</body>



</html>