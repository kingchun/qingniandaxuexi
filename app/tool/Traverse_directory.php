<?php

/*
用来遍历文件夹目录
*/
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
?>