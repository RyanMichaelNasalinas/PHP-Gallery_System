<!-- Header  -->
<?php require "includes/header.php";?>

<?php 

$user = new User;

if(!$session->is_signed_in()) {
    redirect("login.php");
}


if(!$user->check_userlevel($_SESSION['user_level'])) {
    redirect('users.php');
}

$errors = [
    'username_err' => '',
    'first_name_err' => '',
    'last_name_err' => '',
    'password_err' => '',
    'confirm_password_err' => '',
    'user_level_err' => ''
];


if(isset($_POST['create'])) {

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

            if(check_empty($_POST['user_level'])) {
                $errors['user_level_err'] = 'User Level field should be empty';
            }

            if (empty($errors['username_err']) && empty($errors['first_name_err']) 
             && empty($errors['last_name_err']) && empty($errors['password_err']) 
             && empty($errors['confirm_password_err']) && empty($errors['user_level_err'])) {

                    $user->username = $_POST['username'];
                    $user->first_name = ucfirst($_POST['first_name']);
                    $user->last_name = ucfirst($_POST['last_name']);
                    $user->password = password_hash($_POST['password'],PASSWORD_DEFAULT);
                    $user->user_level = $_POST['user_level'];

                $user->set_file($_FILES['user_image']);
                $session->message(
                    '<div class="alert-success alert-dismissible fade show text-center" role="alert" id="alert">
                        The user '. $user->username .'  has been added
                    </div>'
                );

                $user->upload_photo();
                $user->save();
                redirect("users.php");
           } 
        }
    }
    
    if(isset($_POST['cancel'])) {
        redirect("add_user.php");
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
            <a href="users.php">Users</a>
        </li>
        <li class="breadcrumb-item active">Add User</li>
        </ol>
        <div class="row justify-content-center">
        
        
        <div class="col-md-6 col-sm-12">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="user_image">Upload Image</label>
                <input type="file" name="user_image" id="user_image" class="form-control">
            </div>
            <div class="form-group">
                <label class="username">Username</label>
                <input type="text" name="username" class="form-control" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
                <?php if(!empty($errors['username_err'] )): ?>
                    <div class="invalid-feeback text-danger text-center">
                        <?= $errors['username_err']; ?>
                    </div>  
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>">
                 <?php if(!empty($errors['first_name_err'] )): ?>
                    <div class="invalid-feeback text-danger text-center">
                        <?= $errors['first_name_err']; ?>
                    </div>  
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>">
                  <?php if(!empty($errors['last_name_err'] )): ?>
                    <div class="invalid-feeback text-danger text-center">
                        <?= $errors['last_name_err']; ?>
                    </div>  
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="password">Password</label>
                <input type="password" name="password" id="" class="form-control" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                  <?php if(!empty($errors['password_err'] )): ?>
                    <div class="invalid-feeback text-danger text-center">
                        <?= $errors['password_err']; ?>
                    </div>  
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label class="password">Confirm Password</label>
                <input type="password" name="confirm_password" id="" class="form-control" value="<?= isset($_POST['confirm_password']) ? $_POST['confirm_password'] : ''; ?>">
                   <?php if(!empty($errors['confirm_password_err'] )): ?>
                    <div class="invalid-feeback text-danger text-center">
                        <?= $errors['confirm_password_err']; ?>
                    </div>  
                <?php endif; ?> 
            </div>

            <div class="form-group">
                <label>User Level</label>
                    <select name="user_level" class="form-control">
                        <option value="">Select User Level</option>
                        <?php if(isset($_POST['user_level']) == 'admin' || isset($_POST['user_level']) == 'user'): ?>
                            <option value="admin" <?= $_POST['user_level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= $_POST['user_level'] == 'user' ? 'selected' : '' ?>>User</option>
                        <?php else: ?>   
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        <?php endif; ?>    
                    </select>
                       <?php if(!empty($errors['user_level_err'] )): ?>
                            <div class="invalid-feeback text-danger text-center">
                                <?= $errors['user_level_err']; ?>
                            </div>  
                    <?php endif; ?> 
            </div>
            <div class="form-group">
                <input type="submit" value="Create" name="create" class="btn btn-primary">
                <input type="submit" value="Cancel" name="cancel" class="btn btn-danger">
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
