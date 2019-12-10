<!-- Header  -->
<?php require "includes/header.php";?>
<?php require "includes/photo_modal.php"; ?>

<?php 

if(!$session->is_signed_in()){redirect("login.php");}

if(empty($_GET['id'])){
    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

     

if(isset($_POST['update'])) {


    if($user) {

     
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];

        $user->username = $username;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->password = password_hash($password,PASSWORD_DEFAULT);
        $user->user_image;

        if(empty($_FILES['user_image'])) {
            $user->save();
            redirect("users.php");
            $session->message(
                '<div class="alert-success alert-dismissible fade show text-center" role="alert" id="alert">
                    The '.$user->username.' user has been updated
                </div>'
            );
        } else {
            $user->set_file($_FILES['user_image']);
            $user->upload_photo();
            $user->save();
            redirect("users.php");
            $session->message(
                '<div class="alert-success alert-dismissible fade show text-center" role="alert" id="alert">
                    The '.$user->username.' user has been updated
                </div>'
            );
        }
    }
}

if(isset($_POST['delete'])) {

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
        <li class="breadcrumb-item active">Edit User</li>
        </ol>
        <div class="row">
        
        <div class="col-md-6 col-sm-12">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="file" name="user_image">
                </div>
                
                <div class="form-group">
                    <label class="username">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= empty($username) ? $user->username : $username; ?>">
                </div>
                <div class="form-group">
                    <label class="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?= empty($first_name) ? $user->first_name : $first_name; ?>">
                </div>
                <div class="form-group">
                    <label class="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?= empty($last_name) ? $user->last_name : $last_name; ?>">
                </div>
                <div class="form-group">
                    <label class="password">Password</label>
                    <input type="password" name="password" class="form-control" value="<?= empty($password) ? $user->password : $password; ?>">
                </div>
                <div class="form-group text-center">
                    <input type="submit" value="Update" name="update" class="btn btn-primary">
                    <a href="delete_user.php?id=<?= $user->id; ?>" id="user_id" value="Delete" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user')">Delete</a>
                </div>  
            </div>

            <div class="col-md-6 col-sm-12 user_image_box">
                <!-- photo_modal.php -->
                <a href="#" data-toggle="modal" data-target="#photo_modal">
                    <img src="<?= $user->image_placeholder(); ?>" class="img-fluid img-thumbnail mx-auto d-block">
                </a>
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
