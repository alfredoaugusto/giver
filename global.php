<?php

function autoLoad($className) {
    // $extension =  spl_autoload_extensions();
    // require_once (__DIR__ . '/' . $className . $extension);
    $path = __DIR__ . "\\$className.php";
    if (file_exists($path)) require $path;
}

spl_autoload_extensions('.php');
spl_autoload_register('autoLoad');