<?php
spl_autoload_register(function($className) {
    $path = "../app/core/" . $className . ".php";
    if (file_exists($path)) {
        require_once $path;
    }
});
?>