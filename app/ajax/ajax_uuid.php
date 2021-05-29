<?php 
//包含数据库连接文件  

/*
如果提交过返回1没有提交过返回0没有找到数据返回-1
暂时没有实现返回-1
*/
include "../../config/mysql.php"; 

$uuid = $_GET['uuid'];  
$affair =$_GET["affair"];//接受唯一编号
if($uuid != ""){
    $sql2 = $mysqli->query("SELECT `status` FROM `student$affair` WHERE `UUID` = $uuid");
    if(!$sql2 == ""){
       while($row = $sql2->fetch_assoc()) {
        $status = ($row["status"]);
   }
 
   
}
    if($sql2== ' '){
        $status =-1;
    }
}
echo($status);

?>