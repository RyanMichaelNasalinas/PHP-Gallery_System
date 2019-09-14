<?php 

//FILE Constants
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR); // = /

define('SITE_ROOT', 'C:' . DS .'xampp' . DS . 'htdocs' . DS . 'Gallery_System');

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');


//Initiate connections
require_once INCLUDES_PATH.DS."config_new.php";
require_once INCLUDES_PATH.DS."functions.php";
// Classes
require_once INCLUDES_PATH.DS."user_class.php";
require_once INCLUDES_PATH.DS."session_class.php";
require_once INCLUDES_PATH.DS."database_class.php";
require_once INCLUDES_PATH.DS."main_class.php";
require_once INCLUDES_PATH.DS."photo_class.php";
require_once INCLUDES_PATH.DS."comment_class.php";
require_once INCLUDES_PATH.DS."paginate_class.php";
?>