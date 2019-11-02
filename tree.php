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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./m/g.png" />
    <link rel="bookmark" href="./m/g.png" />
    <link rel="stylesheet" href="style.css">
    <title>树洞</title>
</head>

<body style="background:rgb(165, 216, 165) ">


    <input class="ubtn" type="button" style="float: left" value="退出" onclick='location.href=("index.html")' />
    <input class="ubtn" type="button" style="float: right" value="消息 <?php
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
            $sql4 = 'select COUNT(*) as total from ctb where (ctb.towho ="'.$_COOKIE["userno"].'" or ctb.zno in (select zno from ztb where sno = "'.$_COOKIE["userno"].'") ) and ctb.createt >'.$_COOKIE["lasttime"].' order by ctb.createt desc;';    
            $result4 = $conn->query($sql4);
        
            //echo $sql4;
            echo $result4->fetch_assoc()["total"];
            //print_r($result4);
        }
        else
        {
            $sql4 = 'select COUNT(*) as total from ctb where (ctb.towho ='.$_COOKIE["userno"].' or ctb.zno in (select zno from ztb where ano = '.$_COOKIE["userno"].') ) and ctb.createt >'.$_COOKIE["lasttime"].' order by ctb.createt desc;';    
            $result4 = $conn->query($sql4);
        
            //echo $sql4;
            echo $result4->fetch_assoc()["total"];
            //print_r($result4);
        }
    ?>" onclick='location.href=("info.php")' />

    
<br><br>
<?php


    echo '<p style="color:white;">身份：'.($_COOKIE["userty"]=="sno"?"半匿名":"匿名").'</p>';

    $sql0 = 'SELECT * FROM ztb where endt >'.(time()+8*3600).' order by endt DESC limit '.$_GET["start"].', 50;';

    $result0 = $conn->query($sql0);

    while($row=$result0->fetch_assoc())
    {
        $isa="ano";
        if($row["ano"]==NULL)
        {
            $isa="sno";
            $name=$row["sno"];
        }
        else 
        {
            $name=$row["ano"];
        }
        if(time()+8*3600-$row["createt"]>24*3600)$cdate=date("m-d",$row["createt"]);else $cdate=date("H:i",$row["createt"]);
        $edate=date("m-d H:i:s",$row["endt"]);
        $rgb=round(255-($row["endt"]-time()-8*3600)/2372);
        $sql1 = 'SELECT zty FROM ktb where xno ="'.$_COOKIE["userno"].'" and xty = "'.$_COOKIE["userty"].'" and zno ='.$row["zno"].';';
        //echo $sql1;
        $result1 = $conn->query($sql1);

        $cars=array(NULL,NULL,NULL,NULL);

        while($row1=$result1->fetch_assoc())
        {
            switch($row1["zty"])
            {
                case 1:
                $cars[0]='disabled="disabled" style="background:gold;opacity: 1;"';break;
                case 2:
                $cars[1]='disabled="disabled" style="background:lightblue;opacity: 1;"';break;
                case 4:
                $cars[3]='disabled="disabled" style="background:lightcoral;opacity: 1;"';break;
                default:
                echo $row1["zty"];break;
            }
        }

        if($result1==False)echo "0000";
        //echo $name;echo $row["zno"];echo $row1["zty"];
        
        

        echo '
        <div class="leaf" style="background:rgb('.$rgb.', 255, '.round(192-$rgb/1.3).')">
        <p style="display:none;margin-top:2%;background:lemonchiffon;padding: 4px;margin-right: 5%">'.$row["zno"].'</p>
        <p style="display:none;margin-top:2%;background:lemonchiffon;padding: 4px;margin-right: 5%">'.$name.'</p>
        <p style="display: inline-block;font-size: 0.8em;margin-right: 5%">创建 '.$cdate.'</p>
        <p style="display: inline-block;font-size: 0.8em">消失 '.$edate.'</p>
        <p style="margin-top:2%;margin-left:10px;margin-right:10px;">'.$row["context"].'</p>

        <button class="fbn" '.$cars[0].' onclick="location.href=(\'dianzan.php?zno='.$row["zno"].'\')" >赞 '.$row["good"].'</button>

        <button class="fbn" '.$cars[1].' onclick="location.href=(\'cai.php?zno='.$row["zno"].'\')">踩</button>
        
        <button class="fbn" '.$cars[2].' onclick="location.href=(\'pinlun.php?zno='.$row["zno"].'\')">评论</button>

        <button class="fbn" '.$cars[3].' onclick="jb('.$row["zno"].')">举报</button>
    </div>';
    }
    $d=$_GET["start"]>=50?$_GET["start"]-50:0;
    $e=$_GET["start"]+50;

    echo '  <br><br><br><br>   
    <input type="button" class="sbnx" value="前页" onclick="location.href=(\'tree.php?start='.$d.'\')"/>
    <input type="button" class="sbnx" value="后页" onclick="location.href=(\'tree.php?start='.$e.'\')"/>
    <br><br><br><br><br><br><br><br><br><br><br>';
?>

    <div class="sender" style="background:rgb(230, 192, 130) ">
        <form action="send.php" method="post" >
            <p style=" margin-top: 10px;color:azure">写点什么？</p>     
            <textarea name="article" id="article" cols="50" rows="2"style="resize:none"  ></textarea>
            <input type="button" class="sbn" id="cdw" value="长文" onclick="changedx()"/>
            <input type="submit" class="sbn" value="发送" onclick="" />
        </form>
    </div>



</body>

<script>
    function changedx(){
        if(document.getElementById("cdw").value=="长文")
        {
            document.getElementById("article").rows=12;
            document.getElementById("cdw").value="短文";
        }
        else{
            document.getElementById("article").rows=2;
            document.getElementById("cdw").value="长文";
        }
    }
    function func(event){
            event.preventDefault();
        }
    function jb(zno){
        if(confirm("确定举报吗？"))
        location.href=('jubao.php?zno='+zno);
    }
</script>

</html>