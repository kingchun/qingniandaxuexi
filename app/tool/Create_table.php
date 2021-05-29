<?php


/*
这是一个根据事务创建唯一数据库的方法
*/

function Create_table($affairs){
include "../config/mysql.php";
/*
快速复制
*/
$sql1=$mysqli->query("CREATE TABLE student$affairs LIKE qndxx.student");
$sql2=$mysqli->query("INSERT student$affairs SELECT * FROM qndxx.student");
}


?>