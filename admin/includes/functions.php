<?php 
//In this file uploaded all the validations and helper functions
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

function check_empty($field) {
    if(empty($field)) {
        return true;
    } else {
        return false;
    }
}

function check_password($password,$confirm_password) {
    if($password != $confirm_password) {
        return true; 
    } else {
        return false;
    }
}




?>