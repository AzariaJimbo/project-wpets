<?php
// require init file
$init_path = "./app/init.php";
define('__INIT_FILE_PATH__', $init_path);

if (file_exists(__INIT_FILE_PATH__)){
    require_once(__INIT_FILE_PATH__);
} else {
    echo "initialisation file not found";
}

// echo date('Y-m-d H:i:s', time());

?>