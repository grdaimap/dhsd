<?php

$rawid=(string)$_POST["rid"];
$rawlength=strlen($rawid);
$rawsum=array_sum(str_split($rawid));

$rawpoint=$rawsum%$rawlength;
// echo $rawid;
// echo '<br>';
// echo $rawlength;
// echo '<br>';
// echo $rawpoint;
// echo '<br>';
$rawid1=substr($rawid,0,$rawpoint);
$rawid2=substr($rawid,$rawpoint,$rawlength);
$newid=$rawid1.$rawsum.$rawid2;

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
    
    $sql = 'UPDATE stb SET sno = "'."s".$newid.'" where sno ="'."s".$_POST["rid"].'";';
    $sql1 = 'UPDATE ztb SET sno = "'."s".$newid.'" where sno ="'."s".$_POST["rid"].'";';
    $sql2 = 'UPDATE ctb SET towho = "'."s".$newid.'" where towho = "'."s".$_POST["rid"].'";';
    $sql3 = 'UPDATE ctb SET fromwho = "'."s".$newid.'" where fromwho = "'."s".$_POST["rid"].'";';
    $sql4 = 'UPDATE ktb SET xno = "'."s".$newid.'" where xno = "'."s".$_POST["rid"].'";';
  
echo $_POST["rid"];
// echo $rawid;
echo '<br>';
echo $rawlength;
echo '<br>';
echo $rawpoint;
echo '<br>';
echo $rawid1;
echo '<br>';
echo $rawid2;
// echo '<br>';
echo '<br>';
echo $newid;
echo '<br>';
echo $sql;
echo '<br>';
echo $sql1;
echo '<br>';
echo $sql2;
echo '<br>';
echo $sql3;
echo '<br>';







$result=$conn->query($sql);
$result1=$conn->query($sql1);
$result2=$conn->query($sql2);
$result3=$conn->query($sql3);
$result4=$conn->query($sql4);


header("location:admin.html");






?>