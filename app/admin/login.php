<?php 
//登录 
if(!isset($_POST["submit"])){  
    exit('非法访问!');  
}  
$username = $_POST['username'];  
$password = (md5($_POST['password']));
   
//包含数据库连接文件  
include "../../config/mysql.php"; 
//检测用户名及密码是否正确  
$check_query =  $mysqli->query("select password from user_list where username='$username'");  
   if($check_query){
    while($row = $check_query->fetch_assoc()) {
        $pass = ($row["password"]);
        #echo("$pass");
        }
   }else{
       echo("这个id确定存在？");
   }
if($password==$pass){  
    //登录成功  
    session_start();  
    $_SESSION['username'] = $username;  
    $_SESSION['userid'] = $result['userid'];  
    echo $username,' 欢迎你！进入 <a href="my.php">用户中心</a><br />';  
    echo '点击此处 <a href="login.php?action=logout">注销</a> 登录！<br />';  
    exit;  
} else {  
    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');  
}  
   
   
   
//注销登录  
if($_GET['action'] == "logout"){  
    unset($_SESSION['userid']);  
    unset($_SESSION['username']);  
    echo '注销登录成功！点击此处 <a href="index.html">登录</a>';  
    exit;  
}  
   


?>