<?php

session_start();
if($_SESSION['username']==""){
echo "<script>alert('请先登录！');window.location.href='index.php';</script>";
print("---");
exit();
} 
$affair =$_GET["url"];//接受唯一编号

if($affair==""){
    exit();
}


function deldir($dir) {
	//先删除目录下的文件：
	$dh = opendir($dir);
	while ($file = readdir($dh)) {
		if($file != "." && $file!="..") {
		$fullpath = $dir."/".$file;
		if(!is_dir($fullpath)) {
			unlink($fullpath);
		} else {
			deldir($fullpath);
		}
		}
	}
	closedir($dh);
	
	//删除当前文件夹：
	if(rmdir($dir)) {
		return true;
	} else {
		return false;
	}
}


function rmfile($data){
    
$status=unlink($data);    
if($status){  
 return true;   
}else{  
return false;     
}

    
}


function filename($affair){
    
include "../../config/mysql.php"; 
//检测用户名及密码是否正确  
$sql =  $mysqli->query("select zip_name from tmp where url='$affair'");  
   if($sql){
    while($row = $sql->fetch_assoc()) {
        $name = ($row["zip_name"]);
        return $name;
        }
   }else{
       echo("这个id确定存在？");
   }
    
}


function rmdb($affair){
    
include "../../config/mysql.php"; 
//检测用户名及密码是否正确  
$sql =  $mysqli->query("DROP TABLE `qndxx`.`student$affair`");  
$sql2 =  $mysqli->query("DELETE FROM `tmp` WHERE table = '$affair'");  
    
}

function rmdb2($affair){
    
include "../../config/mysql.php"; 
//检测用户名及密码是否正确  
$sql =  $mysqli->query("DELETE FROM `tmp` WHERE `url` = '$affair'");  
echo($affair);    
}

deldir("../tmp/$affair");
$filename = '../tmp/' . filename($affair) . '.zip';
rmfile("$filename");
rmdb($affair);
rmdb2($affair);
echo($affair);
?>