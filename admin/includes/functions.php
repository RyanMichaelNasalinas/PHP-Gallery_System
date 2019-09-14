<?php 

function autoloaderClass($class) {

    $class = strtolower($class);
    $path = "includes/{$class}_class.php";

    if(is_file($path) && !class_exists($class)) {
        include $path;
    }
}

spl_autoload_register('autoloaderClass');

function redirect($location) {

    header("Location: $location");
}


?>