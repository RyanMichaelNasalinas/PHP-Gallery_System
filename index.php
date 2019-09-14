<?php 

require "includes/header.php"; 



$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page = 6;

$items_total_count = Photo::count_all();


$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";
$photos = Photo::find_by_query($sql); 

?>



<body>

  <!-- Navigation -->
    <?php require "includes/navigation.php"; ?>
  <!-- /Navigation -->

  <!-- Page Content -->
  <div class="container thumbnails">
    <div class="row">
      <!-- Blog Entries Column -->
      <div class="col-md-12 col-lg-12">  
        <div class="row">
        <?php foreach($photos as $photo): ?>
            <div class="col-xs-4 col-md-4 ">
              <a href="comments.php?id=<?= $photo->id; ?>"> 
                  <img src="admin\<?= $photo->picture_path(); ?>" class="img-thumbnail d-block mx-auto images-thumbnail">
              </a>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->

  <!-- Pagination -->
  <div class="container">
    <div class="row d-block mx-auto">
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center pagination-md">
            <?php if($paginate->has_prev()): ?>
              <li class="page-item">
              <?php else: ?>
              <li class="page-item disabled">
            <?php endif; ?>
            <a class="page-link" href="index.php?page<?= $paginate->prev(); ?>" aria-label="Previous">
              <span aria-hidden="true">Prev<!-- &laquo; --></span>
              <span class="sr-only">Previous</span>
            </a>
       
          </li>
          <?php for($i = 1;$i <= $paginate->page_total(); $i++): ?>
            <?php if($i == $paginate->current_page): ?>
              <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
            <?php else: ?>
            <li class="page-item"><a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
            <?php endif; ?>
          <?php endfor; ?>
          <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li> -->


        <?php if($paginate->has_next()): ?>
          <li class="page-item">
        <?php else: ?>
        <li class="page-item disabled">
        <?php endif; ?>   
            <a class="page-link" href="index.php?page=<?= $paginate->next(); ?>" aria-label="Next">
              <span aria-hidden="true">Next<!-- &raquo; --></span>
              <span class="sr-only">Next</span>
            </a>
          </li>
     
       
   
        </ul>
    
      </nav>
    </div>
  </div>


<?php require "includes/footer.php"; ?>