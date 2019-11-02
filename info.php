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
    <link rel="stylesheet" href="style.css">
    <title>消息</title>
</head>

<body style="background:rgb(199, 192, 176) ">
 

    <input class="ubtn" type="button" style="float: left" value="返回"onclick='location.href=("tree.php?start=0")'/>
    <input class="ubtn" type="button" style="float: right" value="设置" onclick='location.href=("sz.php")'/>
    
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
    if($_COOKIE["userty"]=="sno"){
        $sql0 = 'UPDATE stb SET endt = '.(time()+8*3600).' where sno = "'.$_COOKIE["userno"].'"';
        $result0 = $conn->query($sql0);
        $lasttime=$_COOKIE["lasttime"];
        //$_COOKIE["lasttime"]=time()+8*3600;
        setcookie("lasttime",time()+8*3600,time()+1200);
        $sql1 = 'select ctb.fnick,ctb.tnick,ctb.context,ctb.zno,ctb.createt from ctb where ctb.towho ="'.$_COOKIE["userno"].'" or ctb.zno in (select zno from ztb where sno = "'.$_COOKIE["userno"].'")  order by ctb.createt desc limit 50;';    
        $result1 = $conn->query($sql1);
        while($row=$result1->fetch_assoc())
        {
            $cdate=NULL;
            //if($_COOKIE["userty"]=="ano"&&$name!=$_COOKIE["userno"])$forbid='disabled="disabled"';
            if(time()+8*3600-$row["createt"]>365*24*3600)$cdate=date("y-m-d",$row["createt"]);
            else if(time()+8*3600-$row["createt"]>24*3600)$cdate=date("m-d",$row["createt"]);
            else $cdate=date("H:i",$row["createt"]);
             
            echo '<input type="button" class="cmt" value="'.$cdate.' | '.$row["fnick"] .' @ '. $row["tnick"].':    ( '.$row["context"] .' )" onclick=\'location.href=("pinlun.php?zno='.$row["zno"].'")\'/>';
        }

    }
    else
    {
        $sql0 = 'UPDATE atb SET endt = '.(time()+8*3600).' where ano = '.$_COOKIE["userno"];
        $result0 = $conn->query($sql0);
        $lasttime=$_COOKIE["lasttime"];
        //$_COOKIE["lasttime"]=time()+8*3600;
        setcookie("lasttime",time()+8*3600,time()+1200);
        $sql1 = 'select ctb.fnick,ctb.tnick,ctb.context,ctb.zno,ctb.createt from ctb where ctb.towho ="'.$_COOKIE["userno"].'" or ctb.zno in (select zno from ztb where ano = '.$_COOKIE["userno"].')   order by ctb.createt desc limit 50;';
        //echo  $sql1;   
        $result1 = $conn->query($sql1);
        while($row=$result1->fetch_assoc())
        {
            $cdate=NULL;
            //if($_COOKIE["userty"]=="ano"&&$name!=$_COOKIE["userno"])$forbid='disabled="disabled"';
            if(time()+8*3600-$row["createt"]>365*24*3600)$cdate=date("y-m-d",$row["createt"]);
            else if(time()+8*3600-$row["createt"]>24*3600)$cdate=date("m-d",$row["createt"]);
            else $cdate=date("H:i",$row["createt"]);
             
            echo '<input type="button" class="cmt" value="'.$cdate.' | '.$row["fnick"] .' @ '. $row["tnick"].':   ( '.$row["context"] .' )" onclick=\'location.href=("pinlun.php?zno='.$row["zno"].'")\'/>';
        }

    }



  

    ?>



</body>



</html>