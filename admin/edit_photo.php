<!-- Header  -->
<?php require "includes/header.php";?>

<?php 

if(!$session->is_signed_in()){redirect("login.php");}


if(empty($_GET['id'])) {
  redirect("photos.php");
} else {
   $photo = Photo::find_by_id($_GET['id']);

   if(isset($_POST['update'])) {
      if($photo) {
        $photo->title = $_POST['title'];
        $photo->caption = $_POST['caption'];
        $photo->alternate_text = $_POST['alternate_text'];
        $photo->description = $_POST['description'];

        $photo->save();
      }
   }
}



if(isset($_POST['update'])) {
  // echo "Test";
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
          Photos <small class="text-muted">subheading</small>
        </h1> 
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="photos.php">Photos</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>
        <div class="row">
         <hr/>
        <div class="col-md-8 col-sm-12">
          <form action="" method="POST">
              <div class="form-group">
                  <input type="text" name="title" class="form-control" value="<?= $photo->title; ?>">
              </div>
             <div class="form-group">
                <a href="#">
                    <img src="<?= $photo->picture_path(); ?>" class="mx-auto d-block img-fluid" >
                </a>
             </div> 
              <div class="form-group">
                  <label class="caption">Caption</label>
                  <input type="text" name="caption" class="form-control" value="<?= $photo->caption; ?>">
              </div>
              <div class="form-group">
                  <label class="caption">Alternate Text</label>
                  <input type="text" name="alternate_text" class="form-control" value="<?= $photo->alternate_text; ?>">
              </div>
              <div class="form-group">
                  <label class="caption">Description</label>
                 <textarea name="description" id="" class="form-control"><?= htmlentities($photo->description); ?></textarea>
            </div>  
        </div>
          <div class="col-md-4 col-sm-12">
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">Save</h5>
                <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-calendar-times"></i>&nbsp;Uploaded On: <?php echo date("m/d/y"); ?></h6>
                <p class="card-text"><b>Photo ID:</b></p>
                <p class="card-text"><b>Filename:</b></p>
                <p class="card-text"><b>File Type:</b></p>
                <p class="card-text"><b>File Size:</b></p>
                <div>
                  <a href="delete_photo.php?id=<?= $photo->id; ?>" class="btn btn-danger" name="delete">Delete<a/>
                  <input type="submit" value="Update" class="btn btn-primary float-right" name="update">
                </div>
              </div>
            </div>            
          </div>
          </form> 
        </div>
      <!-- /Content -->

      </div>
    <!-- /.content-wrapper -->
    </div>
  <!-- /#wrapper -->

<!-- Footer -->
<?php require "includes/footer.php"; ?>
<!-- /Footer -->
