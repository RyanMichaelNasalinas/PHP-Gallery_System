<!-- Header  -->
<?php 
   require "includes/header.php";
   //Redirect back to login.php if user is not login in
   (!$session->is_signed_in()) ? redirect('login.php') : '';
   
   $user_level = new User;
   
   if($user_level->check_userlevel($_SESSION['user_level'])) {
     $users = User::find_all(); 
   } else {
     $users = User::find_by_query("SELECT * FROM users WHERE id = ".$_SESSION['user_id']."");
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
               Users
            </h1>
            <!-- Breadcrumbs-->
            <ol class="breadcrumb mt-2">
               <?php if($user_level->check_userlevel($_SESSION['user_level'])): ?>
               <li class="breadcrumb-item active">Users</li>
               <?php else: ?>
               <li class="breadcrumb-item active">My Profile</li>
               <?php endif; ?>
            </ol>
            <?= $message ?>
            <div class="row mb-2">
               <div class="col-md-12">
                  <?php if($user_level->check_userlevel($_SESSION['user_level'])): ?>
                  <a href="add_user.php" class="btn btn-primary btn-md" title="Add New User">Add New User</a>
                  <?php endif; ?>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="table-responsive">
                     <table class="table table-hover text-center">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Photo</th>
                              <th>Username</th>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <?php if($user_level->check_userlevel($_SESSION['user_level'])): ?>
                              <th>User Level</th>
                              <?php endif; ?>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach($users as $user): ?>
                           <tr>
                              <td><?= $user->id; ?></td>
                              <td>
                                 <img src="<?= $user->image_placeholder(); ?>" height="70" width="70" class="img-fluid mb-2">
                                 <div class="pic_link">
                                    <a href="delete_user.php?id=<?= $user->id; ?>" title="delete" onclick="return confirm('Are you sure you want to delete this user?');">
                                    Delete
                                    </a><!-- <i class="fas fa-trash-alt text-danger" ></i> -->
                                    <a href="edit_user.php?id=<?= $user->id; ?>" title="edit">Edit</a> <!-- <i class="fas fa-edit"></i> -->
                                 </div>
                              </td>
                              <td><?= $user->username; ?>
                              </td>
                              <td><?= $user->first_name; ?></td>
                              <td><?= $user->last_name; ?></td>
                              <?php if($user->check_userlevel($_SESSION['user_level'])): ?>
                              <td><?= $user->user_level; ?></td>
                              <?php endif; ?>
                              <?php endforeach; ?> 
                           </tr>
                        </tbody>
                     </table>
                  </div>
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