<?php 
  //Header
  require "includes/header.php";
  //Null coalescing check if ID is get
  $_GET['id'] ?? redirect('index.php');

  $photo = Photo::find_by_id($_GET['id']);

  if(isset($_POST['submit'])) {
    
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);
    $new_comment = Comment::create_comment($photo->id, $author, $body);

    if($new_comment && $new_comment->save()) {
      redirect("comments.php?id={$photo->id}");
    } else {
      $messge = "There was an error encoutered";
    }

  } else {
    //Make the value empty if not get any value
    $author = "";
    $body = "";
  }

  $comments = Comment::find_comments($_GET['id']);

?>

<body>
  <!-- Navigation -->
  <?php require "includes/navigation.php"; ?>
  <!-- /Navigation -->

  <!-- Page Content -->
  <div class="container">
    <div class="row mt-5">
        <div class="col-lg-6">
          <a class="btn btn-dark text-white" href="index.php">Back</a>      
        </div>
    </div>
  
    <div class="row">
      <!-- Post Content Column -->
      <div class="col-lg-12 col-md-12">
      
        <!-- Title -->
        <h1 class="mt-4"><?= $photo->title; ?></h1>

        <!-- Author -->
        <p class="lead">
          by
          <b><?= $photo->uploaded_by; ?></b>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on <?= $photo->date_uploaded; ?></p>

        <hr>

        <!-- Preview Image -->

        <img class="img-fluid rounded d-block mx-auto" src="admin/<?= $photo->picture_path(); ?>" alt="">

        <hr>

        <!-- Post Content -->
        <h1 class="text-center"><?= $photo->caption; ?></h1>

        <p><?= $photo->description; ?></p>

        <hr>

      
        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form method="post" action="">
              <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" id="" class="form-control" value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
              </div>
              <div class="form-group">
                <textarea name="body" class="form-control" class="form-control"></textarea>
              </div>
            
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

  
        <!-- Comment  -->
        <?php foreach($comments as $comment):?>
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="images/placeholder2.png" alt="">
          <div class="media-body">
            <h5 class="mt-0"><?= $comment->author; ?></h5>
            <?= $comment->body?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <!-- Sidebar Widgets Column -->
      <?php //require "includes/sidebar.php"; ?>
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->




    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

<?php require "includes/footer.php"; ?>