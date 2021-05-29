<?php


/*
这是一个根据事务删除唯一数据库的方法
*/

function Drop_table($affairs){
include "../config/mysql.php";
/*
删除
*/
$sql1=$mysqli->query("DROP TABLE `qndxx`.`student$affairs`");
}


?>