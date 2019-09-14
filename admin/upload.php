<!-- Header  -->
<?php 
  require "includes/header.php";
  //Redirect back to login.php if user is not login in
  (!$session->is_signed_in()) ? redirect('login.php') : '';

  $message= "";
  if(isset($_POST['submit'])) {
      $photo = new Photo;
      $photo->title = $_POST['title'];
      $photo->set_file($_FILES['file_upload']);

      if($photo->save()) {
        $message = "Photo uploaded successfully";
      } else {
        $message = join("<br>", $photo->errors);
      }
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
          Upload 
        </h1> 
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>
       <div class="col-md-6">  
         <?= $message; ?> 
        <form action="" method="post" enctype="multipart/form-data">  
            <div class="form-group">
                <input type="text" name="title" id="" class="form-control">
            </div>
            <div class="form-group">
              <input type="file" name="file_upload" id="" class="btn btn-secondary">
          </div>
          <input type="submit" name="submit" class="btn btn-primary">
        </form>
    
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
