<?php 
//登录
session_start();
if($_SESSION['username']==""){
echo "<script>alert('请先登录！');window.location.href='index.php';</script>";
print("---");
exit();
}


$affair =$_GET["url"];//接受唯一编号
$path = "../tmp/$affair/img";


    function list_dir( $dir ) {

        $result = array();

        if ( is_dir( $dir ) ) {
            # 读取当前文件夹下的文件
            $files_dir = scandir( $dir );
            foreach ( $files_dir as $file ) {
                # 循环处理文件夹下的文件
                if ( $file == '.' || $file == '..' ) {
                    # 跳过名为 . 和 .. 的文件
                    continue;
                } elseif ( is_dir( $dir.$file ) ) {
                    # 如果文件夹内还有文件夹 则递归调用本函数
                    $result = array_merge( $result, list_dir( $dir.$file.'/') );
                } else {
                    array_push( $result, $dir.$file );
                }
            }
        }

        return $result;
    }

    $datalist = list_dir( $path . '/' );
    //压缩后文件名
    $zipname_mysql=zip_name($affair);
    $path2='../tmp/' . $zipname_mysql; 
    $zipname = $path2 . '.zip';
    if ( !file_exists( $zipname ) ) {

        # 初始化ZipArchive对象
        $zip = new ZipArchive();
        #ZIPARCHIVE::CREATE参数，压缩文件不存在会创建一个，已经存在就往里面添加内容
        if ( $zip->open( $zipname, ZIPARCHIVE::CREATE ) !== true ) {
            echo "3";
            echo '无法打开文件，或者文件创建失败';
        }

        foreach ($datalist as $val ) {
            #循环遍历文件放入压缩文件夹中
            if ( file_exists( $val ) ) {
                $zip->addFile( $val , basename( $val ) );
            }
        }

        $zip->close();
    }

echo(" <meta http-equiv=\"refresh\" content=\"10;url= ./admin.php \">");



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

?>
<p align="center"><span id="second">5</span>后自动跳转</p>
	<script type="text/javascript">
		setTimeout(function(){
		    window.location.replace("admin.php")
		},5000);
		
		setInterval(function(){
		 var second = document.getElementById("second").innerHTML;
		second--;
		document.getElementById("second").innerHTML=second;
		},1000) 
	</script>








	</body>
</html>