<!DOCTYPE html>
<html>
	<head>
		 <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
		<title></title>

	</head>
	<body>

<?php
$affair =$_GET["affair"];//接受唯一编号
include "../../../config/mysql.php"; //使用数据库的配置文件
if($affair==""){
    $sql = $mysqli->query("SELECT * FROM `student` WHERE 1");
    
}else{
    $sql = $mysqli->query("SELECT `name`, `sid`, `UUID`, `status`, `class` FROM `student$affair` WHERE 1");
};


    if($sql){

        $rows = $sql->num_rows;
        echo "<table class=table>
                <tr>
                    <th>名称</th>
                    <th>简写学号</th>
                    <th>唯一学号</th>
                    <th>状态(0为空1为已交)</th>
                    <th>班级</th>
                <tr>
        ";

        if($rows){
            while($row = $sql->fetch_assoc()){
                echo "<tr>
                            <td>".$row['name']."</td>
                            <td>".$row['sid']."</td>
                            <td>".$row['UUID']."</td>
                            <td>".$row['status']."</td>
                            <td>".$row['class']."</td>
                    </tr>
                ";
            }
            echo "</table>";
        }else{
            echo '没有您要找的数据。<br>';
        }
    }else{
        echo 'MySQL语句有误。<br>'.$mysqli->error.'<br>';
    }
?>
	</body>
</html>