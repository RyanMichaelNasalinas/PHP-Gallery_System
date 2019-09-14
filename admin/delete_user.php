<!-- Header  -->
<?php 
require "includes/init.php";

if(!$session->is_signed_in()){redirect("login.php");}


if(empty($_GET['id'])) {
    redirect("photos.php");
}

$user = User::find_by_id($_GET['id']);

if($user) {
    $user->delete_photo();
    redirect("users.php");
    $session->message(
        '<div class="alert-danger alert-dismissible fade show text-center" role="alert" id="alert">
            The '. $user->username .' user has been deleted
        </div>'
    );
} else {
    redirect("users.php");
}


?>
<!-- /Header  -->


