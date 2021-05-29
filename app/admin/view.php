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

$affair =$_GET["url"];//接受唯一编号

if($affair==""){
    exit();
}


function weijiao($affair){ 
include "../../config/mysql.php"; 
        $sql3 = $mysqli->query("SELECT name  FROM student$affair WHERE `status` = 0");
        while($row = $sql3->fetch_assoc()) {
        $zong2 .= ($row["name"]);
        $zong2 .= ',  ';
        }
        return $zong2;
} 
$name=weijiao($affair);
echo("
<span>未交:</span>
<p>$name</p>
");