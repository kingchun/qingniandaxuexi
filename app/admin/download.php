<?php

$affair =$_GET["url"];//接受唯一编号
if($affair==""){
    exit();
}


 function zip_name($affair) {
     include "../../config/mysql.php"; 
     $name =  $mysqli->query("SELECT `zip_name` FROM `tmp` WHERE `url` = '$affair'");  
   if($name){
    while($row = $name->fetch_assoc()) {
        $zipname = ($row["zip_name"]);
        #echo("$pass");
        }
   }else{
       echo("这个id确定存在？");
   }
   return $zipname;
 }
 


//$filePath是服务器的文件地址
//$saveAsFileName是用户指定的下载后的文件名
function downloadFile($filePath,$saveAsFileName){

    // 清空缓冲区并关闭输出缓冲
    ob_end_clean();    

    //r: 以只读方式打开，b: 强制使用二进制模式
    $fileHandle=fopen($filePath,"rb");    
    if($fileHandle===false){
        echo "Can not find file: $filePath\n";
        exit;
    }
    
    Header("Content-type: application/octet-stream");
    Header("Content-Transfer-Encoding: binary");
    Header("Accept-Ranges: bytes");
    Header("Content-Length: ".filesize($filePath));
    Header("Content-Disposition: attachment; filename=\"$saveAsFileName\"");
    
    while(!feof($fileHandle)) {
    
        //从文件指针 handle 读取最多 length 个字节
        echo fread($fileHandle, 32768);    
    }
    fclose($fileHandle);
}

$zipname='../tmp/' . zip_name($affair) . '.zip';
//echo($zipname);
$zipname2 = zip_name($affair) . '.zip';

//页面加载的时候就调用
downloadFile("$zipname","$zipname2");