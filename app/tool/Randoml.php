<?php

/*
随机生成字母用来生成事务随机识别
$leng 表示长度
*/

 function Randoml($leng){
$code = '';
for($i=1;$i<=$leng;$i++){
    $code .= chr(rand(97,122));
}
return $code;
}
?>