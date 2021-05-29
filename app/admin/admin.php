<!DOCTYPE html>
<html>
	<head>
		 <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
		<title></title>
            <style type="text/css">
			
			a{
			text-decoration:none;
			color:#333;
			}
			div{
				border: 0.3125rem solid aliceblue;
				margin: 0.625rem;
			}
		</style>
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
echo('
		<p align="center"><a href="new.html">点我新建事务</a></p>
');

include "../../config/mysql.php"; //使用数据库的配置文件

 $sql = $mysqli->query("SELECT `name`,`url` FROM `tmp`");
       if($sql != ""){
       while($row = $sql->fetch_assoc()) {
        $name = ($row["name"]);
        $url = ($row["url"]);
        
        $affairs=$url;
        $zong2=zong2($affairs);
        $zong=zong($affairs);
        $bili3 = sprintf('%.2f', $zong2/$zong*100);
        echo("
    		<div id=''>
    		<p><span>$name</span></p>
			<a href='tozip.php?url=$url'>创建压缩包</a>
			<a href='download.php?url=$url'>下载</a>
			<a href='delete.php?url=$url'>删除事务</a>
			<a href='view.php?url=$url'>查看详细</a>
			<p>完成率%<span>$bili3</span></p>
		</div>
        ");
   }
   }
function zong($affair){ 
include "../../config/mysql.php"; 
    $sql2 = $mysqli->query("SELECT COUNT(*) as'zong' FROM student$affair");
        while($row = $sql2->fetch_assoc()) {
        $zong = ($row["zong"]);
        }
        return $zong;
}
 
function zong2($affair){ 
include "../../config/mysql.php"; 
        $sql3 = $mysqli->query("SELECT COUNT(*)  FROM student$affair WHERE `status` = 1");
        while($row = $sql3->fetch_assoc()) {
        $zong2 = ($row["COUNT(*)"]);
        }
        return $zong2;
} 
 
   
?>
	</body>
</html>