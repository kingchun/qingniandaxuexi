<?php
$affair = $_GET['affair']; 
echo("<p id=\"affair1\" hidden >$affair</p>");
?>
<html>
<head>
 <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
<title>提交文件</title>
</head>
<body>

<form action="upload_file.php" method="post" enctype="multipart/form-data">
      <p align="center">  学号:<input type="text" name="sid" id="sid" onkeyup="showHint(this.value)">
      </p>
    <p align="center">  <label for="file">文件名：</label></p>
    <p align="center"><input type="file" name="file" id="file"></p>
    <input hidden type="text" name="affair" id="affair">
    <p align="center"> <input type="submit" name="submit" value="提交"></p>
</form>
<p>只需要写2030那个学号就行 会自动帮图片打上水印</p>
<p>是否提交过: <span id="txtHint"></span></p>
<p align="center">1为提交过-1为没查询到此学号</p>
</body>
	<script type="text/javascript">
		var affair =document.getElementById("affair1").innerHTML;
		console.log(affair);
		document.getElementById("affair").value = affair;
		/*
		ajax_uuid
		*/
		function showHint(str)
{
	if (str.length==0)
    { 
        document.getElementById("txtHint").innerHTML="";
        return;
    }
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {    
        //IE6, IE5 浏览器执行的代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","ajax/ajax_uuid.php?uuid="+str+'&affair='+affair,true);
    xmlhttp.send();
}	
	</script>
</html>

