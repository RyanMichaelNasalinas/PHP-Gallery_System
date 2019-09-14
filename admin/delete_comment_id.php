<!-- Header  -->
<?php 
require "includes/init.php";

if(!$session->is_signed_in()){redirect("login.php");}


if(empty($_GET['id'])) {
    redirect("comments.php");
}

$comment = Comment::find_by_id($_GET['id']);

if($comment) {
    $comment->delete();
    $session->message(
        '<div class="alert-danger alert-dismissible fade show text-center" role="alert" id="alert">
            The comment with id '. $comment->photo_id .'  has been deleted
        </div>'
    );
    redirect("comment_photo.php?id={$comment->photo_id}");
} else {
    redirect("comment_photo.php?id={$comment->photo_id}");
}


?>
<!-- /Header  -->




