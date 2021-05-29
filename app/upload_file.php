<html>
<head>
 <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
<title>提交文件</title>
</head>
<body>


<?php
// 允许上传的图片后缀
$sid = $_POST['sid']; //学号
$affair = $_POST['affair']; //事务
#$path = "tmp/" . $affair . "/upload/"; //路径
$path = "tmp/$affair/upload/"; //路径
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
//echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2048000)   // 小于 2000 kb
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        #echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        #echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        #echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        #echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
        #echo("<p>上传完成,感谢你的配合$sid</p>");
        // 判断当前目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("$path" . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            #move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
            #move_uploaded_file($_FILES["file"]["tmp_name"], "$path/" . $_FILES["file"]["name"]);
            #move_uploaded_file($_FILES["file"]["tmp_name"], "tmp/" . $affair . "/upload" . $_FILES["file"]["name"]);
            move_uploaded_file($_FILES["file"]["tmp_name"],$path . $_FILES["file"]["name"]);
            move_uploaded_file($path . $_FILES["file"]["name"],$path . $_FILES["file"]["name"]);
           # echo "文件存储在: " . "$path" . $_FILES["file"]["name"];
        }
    }
}
else
{
    echo "非法的文件格式";
}
$img = $_FILES["file"]["name"];
$dst_path = "$path/$img";//待处理的图片

$pathdai = "tmp/$affair/img/";
$url = $affair;
$uuid = $sid;
Watermark($pathdai,$dst_path,$url,$uuid);


function Watermark($path,$dst_path,$url,$uuid){
    /*
    $path 位处理后的保存路径
    $dst_path = '1.jpg'; 需要处理的文件名称
    $name 处理后文件的名称
    $url 为事务特征
    $uuid 为唯一学号
    */
include "../config/mysql.php";
 
$user_name = "";
$class = "";
$UUID = "";
   
 $sql = $mysqli->query("SELECT `name`, `UUID`, `class` FROM `student` WHERE `UUID` = $uuid");
       if(!$sql == ""){
       while($row = $sql->fetch_assoc()) {
        $user_name = ($row["name"]);
        $class = ($row["class"]);
        $UUID = ($row["UUID"]);
        
   }
   }
$text =$user_name . PHP_EOL . $class . PHP_EOL . $UUID;
#$path="./img/"; 
#$dst_path = '1.jpg';
$name ="$uuid.jpg";
//创建图片的实例
$dst = imagecreatefromstring(file_get_contents($dst_path));
//打上文字
$font = './fs.ttf';//字体
$black = imagecolorallocate($dst, 0x00, 0x00, 0x00);//字体颜色
#imagefttext($dst, 13, 0, 20, 20, $black, $font, $text);
imagefttext($dst, 75, 0, 20, 80, $black, $font, $text);
//输出图片
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
switch ($dst_type) {
case 1://GIF
header('Content-Type: image/gif');
imagegif($dst);
break;
case 2://JPG
#header('Content-Type: image/jpeg');
//imagejpeg($dst);
$save = "$path $name";
imagejpeg($dst, $save);
break;
case 3://PNG
header('Content-Type: image/png');
imagepng($dst);
break;
default:
break;
}
imagedestroy($dst);
echo("上传成功谢谢配合$user_name");
$sql2 = $mysqli->query("UPDATE `student$url` SET `status`= \"1\" WHERE `UUID` =  \"$uuid\"");
return 0;

}

?>
</body>
</html>