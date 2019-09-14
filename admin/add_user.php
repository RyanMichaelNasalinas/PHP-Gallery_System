<!-- Header  -->
<?php require "includes/header.php";?>

<?php 

if(!$session->is_signed_in()){redirect("login.php");}

$user = new User;

if(isset($_POST['create'])) {

    if($user) {

        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        // $user->user_level = $_POST['user_level'];

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
        <div class="row">
        
        <div class="col-md-6 col-sm-12">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" name="user_image" id="">
            </div>
            <div class="form-group">
                <label class="username">Username</label>
                <input type="text" name="username" class="form-control" value="">
            </div>
            <div class="form-group">
                <label class="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="">
            </div>
            <div class="form-group">
                <label class="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="">
            </div>
            <div class="form-group">
                <label class="password">Password</label>
                <input type="password" name="password" id="" class="form-control" value="">
            </div>
            <!-- <div class="form-group">
                <label>User Level</label>
                <select name="user_level" class="form-control">
                    <option>Select User Level</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div> -->
            <div class="form-group">
                <input type="submit" value="Create" name="create" class="btn btn-primary">
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
