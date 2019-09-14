<!-- Header  -->
<?php 
require "includes/init.php";

if(!$session->is_signed_in()){redirect("login.php");}


if(empty($_GET['id'])) {
    redirect("photos.php");
}

$photo = Photo::find_by_id($_GET['id']);

if($photo) {
    $photo->delete_photo();
    redirect("photos.php");
    $session->message(
        '<div class="alert-danger alert-dismissible fade show text-center" role="alert" id="alert">
            The '. $photo->filename .' has been deleted
        </div>'
    );
} else {
    redirect("photos.php");
}



?>
<!-- /Header  -->


