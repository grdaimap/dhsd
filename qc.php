<?php
if (!isset($_COOKIE["userty"])or$_COOKIE["userty"]==NULL)
{
    header("location:index.html");
    die();
}
//echo "<script>alert('')</script>";

if($_COOKIE["userty"]=="sno")
{
	/**
	 * 包含SDK
	 */
	require("./yiban/classes/yb-globals.inc.php");

	//配置文件
	require_once 'config.php';
	
	//初始化
	$api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);
    
    $api->bind($_COOKIE["userpsn"]);

	$res = $api->request('oauth/revoke_token', array('client_id'=>$api->getConfig('appid')), true);

// 	echo '
	
// 	<script type="text/javascript">
// var xmlhttp;

// xmlhttp=null;
// if (window.XMLHttpRequest)
//   {// code for IE7, Firefox, Opera, etc.
//   xmlhttp=new XMLHttpRequest();
//   }
// else if (window.ActiveXObject)
//   {// code for IE6, IE5
//   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//   }
// if (xmlhttp!=null)
//   {
//   xmlhttp.onreadystatechange=state_Change;
//   xmlhttp.open("GET",url,true);
//   xmlhttp.send(null);
//   }
// else
//   {
//   alert("Your browser does not support XMLHTTP.");
//   }


// function state_Change()
// {
// if (xmlhttp.readyState==4)
//   {// 4 = "loaded"
//   if (xmlhttp.status==200)
//     {// 200 = "OK"
// alert("成功");
//     }
//   else
//     {
//     alert("Problem retrieving XML data:" + xmlhttp.statusText);
//     }
//   }
// }
// window.location.href="index.html";
// </script>';

//echo '<iframe style="display:none;" src="http://www.yiban.cn/logout"></iframe>';
    
}


setcookie("userno", NULL);
setcookie("usernick", NULL);
setcookie("userty", NULL);
setcookie("userpsn", NULL);
setcookie("lasttime", NULL);
setcookie("yiban_user_token", NULL,1000,"/",".yiban.cn");
setcookie("UM_distinctid", NULL,1000,"/",".yiban.cn");
setcookie("_YB_OPEN_V2_0", NULL,1000,"/",".yiban.cn");
header("location:index.html");
//header("location:authorize.php");
// echo '<script>window.open("http://www.yiban.cn/logout");
// window.location.href="index.html";
// </script>';
?>