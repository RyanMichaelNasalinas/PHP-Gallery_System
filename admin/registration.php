<?php

  require_once "includes/header.php";
  ///Check if use is signed in
  if($session->is_signed_in()) {
    redirect("index.php");
}

$user = new User;

$errors = [
    'username_err' => '',
    'first_name_err' => '',
    'last_name_err' => '',
    'password_err' => '',
    'confirm_password_err' => ''

];


  if(isset($_POST['register'])) {

        if($user) {

            if(check_empty($_POST['username'])) {
               $errors['username_err'] = 'Username field should not be empty';
            } elseif($user->check_existing_username($_POST['username'])) {
                $errors['username_err'] = 'Username is already existing';
            }

             if(check_empty($_POST['first_name'])) {
               $errors['first_name_err'] = 'First Name field should not be empty';
            }

            if(check_empty($_POST['last_name'])) {
                $errors['last_name_err'] = 'Last Name field should not be empty';
            }

            if(check_empty($_POST['password'])) {
                $errors['password_err'] = 'Password field should not be empty';
            } elseif(strlen($_POST['password']) < 8) {
                $errors['password_err'] = 'Password should be more than 8 characters';
            } elseif(!preg_match('/[A-Z]/',$_POST['password'])) {
                $errors['password_err'] = 'Password should contain atleast a uppercase letter';
            } elseif(!preg_match('/[a-z]/',$_POST['password'])) {
                $errors['password_err'] = 'Password should contain atleat a lowercase letter';
            } elseif(!preg_match('/[0-9]/',$_POST['password'])) {
                $errors['password_err'] = 'Password should contain atleast a number';
            } elseif(!preg_match('/[A-Za-z0-9\s]/',$_POST['password'])) {
                $errors['password_err'] = 'Password should container atleast a special character';
            }

            if(check_empty($_POST['confirm_password'])) {
                $errors['confirm_password_err'] = 'Confirm Password field should not be empty';
            } else {
                if(check_password($_POST['password'],$_POST['confirm_password'])) {
                    $errors['confirm_password_err'] = 'Password is not matched';
                }
            }

           
            if (empty($errors['username_err']) && empty($errors['first_name_err']) 
             && empty($errors['last_name_err']) && empty($errors['password_err']) 
             && empty($errors['confirm_password_err']) && empty($errors['user_level_err'])) {

                    $user->username = $_POST['username'];
                    $user->first_name = ucfirst($_POST['first_name']);
                    $user->last_name = ucfirst($_POST['last_name']);
                    $user->password = password_hash($_POST['password'],PASSWORD_DEFAULT);
                    $user->user_level = "user";

                $user->set_file($_FILES['user_image']);
                $session->message(
                    '<div class="alert-success alert-dismissible fade show text-center" role="alert" id="alert">
                        You are now registered and can login
                    </div>'
                );

                $user->upload_photo();
                $user->save();
                redirect("registration.php");
           } 
        }
    
  }
?>

<body class="bg-dark">
  <div class="container">
      <!-- Error Message -->
    
      <?php //if(isset($_POST['submit'])):?>
      <!-- <div class="container">
          
           </div> -->
      <?php //endif; ?>
        <!-- /Error Messagend --> 
    
    <div class="card card-login mx-auto mt-5 pb-4">
      <div class="card-header">Login</div>
      <div class="card-body">
      <?= $message ?>
        <form method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label for="user_image">Upload Image</label>
          <input type="file" name="user_image" id="user_image" class="form-control">
        </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" autofocus="autofocus" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
              <label for="inputUsername">Username</label>
                <?php if(!empty($errors['username_err'] )): ?>
                    <div class="invalid-feeback text-danger text-center">
                        <?= $errors['username_err']; ?>
                    </div>  
                <?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>">
              <label for="inputPassword">Password</label>
               <?php if(!empty($errors['password_err'] )): ?>
                    <div class="invalid-feeback text-danger text-center">
                        <?= $errors['password_err']; ?>
                    </div>  
                <?php endif; ?>
            </div>
          </div>
           <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="confirm_password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" value="<?= isset($_POST['confirm_password']) ? $_POST['confirm_password'] : ''; ?>">
              <label for="inputConfirmPassword">Confirm Password</label>
               <?php if(!empty($errors['confirm_password_err'] )): ?>
                    <div class="invalid-feeback text-danger text-center">
                        <?= $errors['confirm_password_err']; ?>
                    </div>  
                <?php endif; ?> 
            </div>
          </div>
           <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="first_name" id="inputFirstName" class="form-control" placeholder="First Name" value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>">
              <label for="inputFirstName">First Name</label>
               <?php if(!empty($errors['first_name_err'] )): ?>
                    <div class="invalid-feeback text-danger text-center">
                        <?= $errors['first_name_err']; ?>
                    </div>  
                <?php endif; ?>
            </div>
          </div>
            <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="last_name" id="inputLastName" class="form-control" placeholder="Last Name" value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>">
              <label for="inputLastName">Last Name</label>
              <?php if(!empty($errors['last_name_err'] )): ?>
                    <div class="invalid-feeback text-danger text-center">
                        <?= $errors['last_name_err']; ?>
                    </div>  
                <?php endif; ?>
            </div>
          </div>
          <input class="btn btn-primary btn-block text-white" type="submit" name="register" value="Register">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Already have an Account? Sign In</a>
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
      window.setTimeout(function() {
      $("#alert").fadeTo(500,0).slideUp(500, function(){
          $(this).remove();
      });
  }, 4000);
  });
  </script>
</body>

</html>
