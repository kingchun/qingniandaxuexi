<?php

function Watermark($path,$dst_path,$url,$uuid){
    /*
    $path 位处理后的保存路径
    $dst_path = '1.jpg'; 需要处理的文件名称
    $name 处理后文件的名称
    $url 为事务特征
    $uuid 为唯一学号
    */
    
    
$text ="";
$path="./img/"; 
$dst_path = '1.jpg';
$name ="";
//创建图片的实例
$dst = imagecreatefromstring(file_get_contents($dst_path));
//打上文字
$font = './fs.ttf';//字体
$black = imagecolorallocate($dst, 0x00, 0x00, 0x00);//字体颜色
imagefttext($dst, 13, 0, 20, 20, $black, $font, $text);
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
return 0;
#echo("上传成功谢谢配合");
}
?>