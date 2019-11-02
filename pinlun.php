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
    <title>评论</title>
</head>

<body style="background:rgb(165, 216, 165) ">


    <input class="ubtn" type="button" style="float: left" value="退出" onclick='location.href=("tree.php?start=0")' />
<br>
<br>

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

$sql0 = 'SELECT * FROM ztb where zno = '.$_GET["zno"];

$result0 = $conn->query($sql0);

if($row=$result0->fetch_assoc())
    {
        $forbid="";
        $isa=true;
        if($row["ano"]==NULL)
        {
            $isa=false;
            $name=$row["sno"];
        }
        else 
        {
            $name=$row["ano"];
        }
        if($_COOKIE["userty"]=="ano"&&$name!=$_COOKIE["userno"])$forbid='disabled="disabled"';
        if(time()+8*3600-$row["createt"]>24*3600)$cdate=date("m-d",$row["createt"]);else $cdate=date("H:i",$row["createt"]);
        $edate=date("m-d H:i:s",$row["endt"]);
        echo '
        <div class="leaf">
        <p style="display:none;margin-top:2%;background:lemonchiffon;padding: 4px;margin-right: 5%">'.$row["zno"].'</p>
        <p style="display:none;margin-top:2%;background:lemonchiffon;padding: 4px;margin-right: 5%">'.$name.'</p>
        <p style="display: inline-block;font-size: 0.8em;margin-right: 5%">创建 '.$cdate.'</p>
        <p style="display: inline-block;font-size: 0.8em">消失 '.$edate.'</p>
        <p style="margin-top:2%;margin-left:10px;margin-right:10px;">'.$row["context"].'</p>
        <br>
    </div>';
    }

    $sql1 = 'SELECT * FROM ctb where zno = '.$_GET["zno"].' order by createt DESC ';    
    $result1 = $conn->query($sql1);
    while($row=$result1->fetch_assoc())
    {
        $ddate=0;
        if(time()+8*3600-$row["createt"]>24*3600)
        $ddate=date("m-d",$row["createt"]);else $ddate=date("H:i",$row["createt"]);

        echo '<input type="button" id="'.$row["fromwho"].'" class="cmt" name="'.$row["fnick"].'" value="'.$ddate.' | '.$row["fnick"] .' @ '. $row["tnick"].' : '.$row["context"] .' " onclick="handsup(this)"/>';
    } 
?>

<div class="sender" style="background:rgb(230, 192, 130)">
        <form action="sendpl.php" method="post" >
            <p id="sshow" style=" margin-top: 10px;color:azure">写点什么？</p>
            <input style="display:none" name="name" id="name" type="text" value="<?php echo $name ;?>"/> 
            <input style="display:none" name="zno" type="text" value="<?php echo $_GET["zno"] ;?>"/> 
            <input style="display:none" name="towho" id="towho" type="text" value="-1"/>
            <input style="display:none" name="tnick" id="tnick" type="text" value="帖主"/>
            <textarea name="article" id="article" cols="50" rows="2"style="resize:none"  ></textarea>
            <input type="button" class="sbn" id="cdw" value="重置" onclick="changedx()"/>
            <input type="submit" <?php echo $forbid; ?> class="sbn" value="发送" onclick="" />
        </form>
    </div>



</body>

<script>
    function changedx(){
        document.getElementById("towho").value=-1;
        document.getElementById("tnick").value="帖主";
        document.getElementById("sshow").innerHTML="写点什么？";     
    }
    function func(event){
            event.preventDefault();
        }
    function handsup(e){
        document.getElementById("towho").value=e.id;
        document.getElementById("tnick").value=e.name;
        document.getElementById("sshow").innerHTML="写点什么？ @ "+e.name;        
    }
</script>

</html>