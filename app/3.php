<?php
include "./tool/Randoml.php";
$affair =Randoml(6);
$path = "./tmp/".$affair."/img";
echo("$path");


if(is_dir($path))
{
    echo "当前目录下，目录".$path."存在";
}
else
{
     echo "当前目录下，目录".$path."不存在";
}




?>