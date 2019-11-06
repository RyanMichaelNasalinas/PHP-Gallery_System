<?php 
//In this file uploaded all the validations and helper functions


//Autoloader
function autoloaderClass($class) {

    $class = strtolower($class);
    $path = "includes/{$class}_class.php";

    if(is_file($path) && !class_exists($class)) {
        include $path;
    }
}

spl_autoload_register('autoloaderClass');
//End Autoloader

//Redirect
function redirect($location) {
    header("Location: $location");
}
//End Redirect

//Check Empty
function check_empty($field) {
    if(empty($field)) {
        return true;
    } else {
        return false;
    }
}
//End Empty

//Check Password
function check_password($password,$confirm_password) {
    if($password != $confirm_password) {
        return true; 
    } else {
        return false;
    }
}
//End Check Password





?>