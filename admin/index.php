<!-- Header  -->
<?php 
  require "includes/header.php";

  if(!$session->is_signed_in()){redirect("login.php");}
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
      <?php require "includes/content.php"; ?>
      <!-- /Content -->

      </div>
    <!-- /.content-wrapper -->
    </div>
  <!-- /#wrapper -->

<!-- Footer -->
<?php require "includes/footer.php"; ?>
<!-- /Footer -->
