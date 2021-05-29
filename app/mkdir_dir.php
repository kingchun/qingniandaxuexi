<?php
function mkdir_dir($path,$affairs){
    mkdir("$path/$affairs");
    mkdir("$path/$affairs/img");
    mkdir("$path/$affairs/upload");
}

?>