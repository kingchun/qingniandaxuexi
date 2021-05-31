<!DOCTYPE html>
<html>
	<head>
		 <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
		<title></title>

	</head>
	<body>
<?php

//登录
session_start();
if($_SESSION['username']==""){
echo "<script>alert('请先登录！');window.location.href='index.php';</script>";
print("---");
exit();
}
$affair_name = $_POST['name']; //事务名称
$zipnameold =  $_POST['zipname']; //zip名称
if($affair_name !="" && $zipnameold !=""){
    write($affair_name,$zipnameold);
}else{
    echo("没有值错误");
}
function write($affair_name,$zipnameold){
include "../../config/mysql.php"; //使用数据库的配置文件
include "../tool/Randoml.php"; //使用随机生成
echo ("开启一个新事务");
$affair = Randoml(7);
$zipname =  str_replace(".zip","","$zipnameold");
$now_time =  date('Y-m-d');
mkdir_dir("../tmp",$affair);
echo ($affair_name);
$sql2 = $mysqli->query("INSERT INTO `tmp`(`name`, `table`, `zip_name`, `time`, `url`) VALUES ('$affair_name','$affair','$zipname','$now_time','$affair')");
//echo ($affair);
Create_table($affair);
    
}

function mkdir_dir($path,$affairs){
//    echo("$path/$affairs");
    mkdir("$path/$affairs");
    mkdir("$path/$affairs/img");
    mkdir("$path/$affairs/upload");
}


function Create_table($affairs){
include "../../config/mysql.php";
/*
快速复制
*/
$sql1=$mysqli->query("CREATE TABLE student$affairs LIKE qndxx.student");
$sql2=$mysqli->query("INSERT student$affairs SELECT * FROM qndxx.student");
$sql3=$mysqli->query("ALTER TABLE student$affairs ADD INDEX( `sid`, `UUID`);");
$sql4=$mysqli->query("UPDATE student$affairs SET status='0'");
}


?>
<p align="center"><span id="second">5</span>后自动跳转</p>
	</body>
	<script type="text/javascript">
		setTimeout(function(){
		    window.location.replace("admin.php")
		},5000);
		
		setInterval(function(){
		 var second = document.getElementById("second").innerHTML;
		second--;
		document.getElementById("second").innerHTML=second;
		},1000) 
	</script>
</html>
