<?php 
   $activePage = basename($_SERVER['PHP_SELF'],".php");
   $user_level = new User; 
?>

<ul class="sidebar navbar-nav">
      <li class="nav-item <?php echo (($activePage == 'index') ? 'active' : ''); ?>">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <?php if($user_level->check_userlevel($_SESSION['user_level'])): ?>
      <li class="nav-item <?php echo (($activePage == 'users') ? 'active' : ''); ?>">
        <a class="nav-link" href="users.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Users</span>
        </a>
      </li>
    <?php else: ?>
      <li class="nav-item <?php echo (($activePage == 'users') ? 'active' : ''); ?>">
            <a class="nav-link" href="users.php">
              <i class="fas fa-fw fa-users"></i>
              <span>My Profile</span>
            </a>
          </li>
    <?php endif; ?>
      <li class="nav-item <?php echo (($activePage == 'upload') ? 'active' : ''); ?>">
        <a class="nav-link" href="upload.php">
          <i class="fas fa-fw fa-upload"></i>
          <span>Upload Photo</span>
        </a>
      </li>
      <li class="nav-item <?php echo (($activePage == 'photos') ? 'active' : ''); ?>">
        <a class="nav-link" href="photos.php">
          <i class="fas fa-fw fa-image"></i>
          <span>Photos</span>
        </a>
      </li>
      <li class="nav-item <?php echo (($activePage == 'comments') ? 'active' : ''); ?>">
        <a class="nav-link" href="comments.php">
          <i class="fas fa-fw fa-comments"></i>
          <span>Comments</span>
        </a>
      </li>
    </ul>
       <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Login Screens:</h6>
          <a class="dropdown-item" href="login.php">Login</a>
          <a class="dropdown-item" href="register.php">Register</a>
          <a class="dropdown-item" href="forgot-password.php">Forgot Password</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Other Pages:</h6>
          <a class="dropdown-item" href="404.php">404 Page</a>
          <a class="dropdown-item" href="blank.php">Blank Page</a>
        </div>
      </li> -->
