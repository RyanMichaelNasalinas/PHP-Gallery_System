<!-- Header  -->
<?php 
  require "includes/header.php";

  (!$session->is_signed_in()) ? redirect('login.php') : '';

  $user_level = User::check_userlevel($_SESSION['user_level']);

  if($user_level) {
     $photos = Photo::find_all();
  } else {
      $photos = Photo::find_by_query("SELECT * FROM photos WHERE uploaded_by = '".$_SESSION['username']."'");
  }


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
          Photos
        </h1> 
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
          <li class="breadcrumb-item active">Photos</li>
        </ol>

        <?= $message ?>
        
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-hover text-center">
              <thead>
                <tr>
                  <th>Photo</th>
                  <th>ID</th>
                  <th>Description</th>
                  <th>Title</th>
                  <th>Size</th>
                  <th>Comments</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach($photos as $photo): ?>
                <tr>
                  <td>
                    <img src="<?= $photo->picture_path(); ?>" height="100" width="100" class="img-fluid mb-2">
                    
                    <div class="pic_link">
                      <a href="delete_photo.php?id=<?= $photo->id; ?>" title="delete">
                      Delete
                      </a><!-- <i class="fas fa-trash-alt text-danger" ></i> -->

                      <a href="edit_photo.php?id=<?= $photo->id; ?>" title="edit">Edit</a> <!-- <i class="fas fa-edit"></i> -->
                      <a href="../comments.php?id=<?= $photo->id; ?>" title="view">View</a><!-- <i class="fas fa-eye text-dark"></i> -->
                    </div>
                  </td>
                  <td><?= $photo->id; ?></td>
                  <td><?= substr($photo->description,0,20); ?></td>
                  <td><?= $photo->title; ?></td>
                  <td><?= $photo->size; ?></td>
                  <td>
                  <?php $comments = Comment::find_comments($photo->id); ?>
                    <a href="comment_photo.php?id=<?= $photo->id; ?>">
                      <?= count($comments); ?>
                    </a>
                  </td>
                <?php endforeach; ?> 
                </tr>
              </tbody>
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
