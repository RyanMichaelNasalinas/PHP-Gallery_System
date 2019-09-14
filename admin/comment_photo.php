<!-- Header  -->
<?php require "includes/header.php";?>

<?php 

if(!$session->is_signed_in()){redirect("login.php");}

if(empty($_GET['id'])) {
  redirect("photos.php");
}

$comments = Comment::find_comments($_GET['id']);

?>
<!-- /Header  -->

<body id="page-top">

  <!-- Navigation -->
  <?php require "includes/top_nav.php"; ?>
  <!-- /Navigation -->



  <div id="wrapper">
    <!-- Sidebar -->
  <?php require "includes/side_nav.php"; ?>
    <!-- /Sidebar -->
 
    <div id="content-wrapper">

      <!-- Content -->
      <div class="container-fluid">
        <h1>
          Comments
        </h1>

      <!-- <a href="add_user.php" class="btn btn-primary btn-md" title="Add New User">Add New</a> -->
         
          <!-- Breadcrumbs-->
          <ol class="breadcrumb mt-2">
          <li class="breadcrumb-item active">Photos</li>
        </ol>
        <?= $message; ?>
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Author</th>
                  <th>Body</th>
                </tr>
              </thead>
              <tbody> 
              <?php if(!empty($comments)): ?>
                <?php foreach($comments as $comment): ?>
                <tr>
                  <td class="25"><?= $comment->id; ?></td>

                 
                  <td class="25"><?= $comment->author; ?>
                  <div class="pic_link">
                      <a href="delete_comment_id.php?id=<?= $comment->id; ?>" title="delete" onclick="return confirm('Are you sure you want to delete this user?');">
                      Delete
                      </a>       
                    </div>
                </td>
                  <td class="w-50"><?= $comment->body; ?></td>
                <?php endforeach; ?> 
                
                </tr>
              </tbody>
              <?php else: ?>
                  <?= "<h3 class='text-center font-weight-bold text-primary'>No Comments to display</h3>"; ?> 
                <?php endif; ?>
          </table>
        </div>
        </div>
        
      </div>
      <!-- /Content -->

      </div>
    <!-- /.content-wrapper -->
    </div>
  <!-- /#wrapper -->

<!-- Footer -->
<?php require "includes/footer.php"; ?>
<!-- /Footer -->
