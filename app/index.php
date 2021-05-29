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

include "../config/mysql.php";

 $sql = $mysqli->query("SELECT `name`,`url` FROM `tmp`");
       if(!$sql == ""){
       while($row = $sql->fetch_assoc()) {
        $name = ($row["name"]);
        $url = ($row["url"]);
        echo("
        <div id=''>
            
			<p align='center'>$name</p>
			<p align='center'><a href='file.php?affair=$url'>点我转跳提交截图</a></p>
			
		</div>
        ");
   }
   }


?>
	</body>
</html>