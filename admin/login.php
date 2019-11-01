<?php 

require_once "includes/header.php";

///Check if use is signed in
if($session->is_signed_in()) {
    
  redirect("index.php");
}

  if(isset($_POST['submit'])) {

      $username = $_POST['username'];
      $password = $_POST['password'];

      //Method check database credentials

      $user_found = User::verify_user($username,$password);


      if($user_found) {

          // $session->login($user_found);
          redirect("index.php");

      } elseif(empty($_POST['username']) || empty($_POST['password'])) {
        $error_msg = "Username or Password cannot be empty";
      } else {
        $error_msg = "Username or Password are incorrect";
    }
    
  } else {
      $error_msg = "";
      $username = "";
      $password = "";  
  }
?>

<body class="bg-dark">
 
  <div class="container">
      <!-- Error Message -->
    
<!--     
        <div class="alert alert-danger alert-dismissible fade show hide" id="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button> -->
             <h4 class="text-danger text-center alert"> <?= $error_msg; ?></h4>
          <!-- </div> -->
        
        <!-- /Error Messagend --> 
    
    <div class="card card-login mx-auto mt-5 pb-4">
     
      <div class="card-header">Login</div>
      <div class="card-body">
        
        <form method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" autofocus="autofocus" value="<?= htmlentities($username); ?>">
              <label for="inputUsername">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" value=<?= htmlentities($password); ?>>
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <input class="btn btn-primary btn-block text-white" type="submit" name="submit" value="Login">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="#">Register an Account</a>
          <a class="d-block small" href="#">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/jquery/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/jquery-easing/jquery.easing.min.js"></script>
 <script>
   $(document).ready(function(){

      window.setTimeout(function(){
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    },3000);
      
   });
 
    </script>
</body>

</html>
