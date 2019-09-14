  <div class="container-fluid">
    <h1>
        Dashboard <small class="text-muted">Welcome</small>
    </h1>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>
    <div class="row">
        <div class="container">
        </div>
    </div>
    <!-- Icon Cards-->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-eye"></i>
                </div>
                <div class="mr-5">
                  <span class="badge badge-light font-badge"><?= $session->visitor_count; ?></span>&nbsp;Views
              </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
              <i class="fas fa-angle-right"></i>
              </span>
              </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-image"></i>
                </div>
                <div class="mr-5">
                  <span class="badge badge-light font-badge"><?= Photo::count_all(); ?></span>&nbsp;Photos
              </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="photos.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
              <i class="fas fa-angle-right"></i>
              </span>
              </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-users"></i>
                </div>
                <div class="mr-5">
                  <span class="badge badge-light font-badge"><?= User::count_all(); ?></span>&nbsp;Users
                </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="users.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
              <i class="fas fa-angle-right"></i>
              </span>
              </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">
                  <span class="badge badge-light font-badge""><?= Comment::count_all(); ?></span>&nbsp;Comments
                </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="comments.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
              <i class="fas fa-angle-right"></i>
              </span>
              </a>
          </div>
        </div>
    </div>
    <!-- Pie Chart -->

    <div id="content-wrapper">
        <div class="container-fluid">
          <div class="mb-3">
              <div class="col-lg-6 col-sm-12 offset-md-3">
                <div class="card mb-3">
                    <div class="card-header">
                      <i class="fas fa-chart-pie"></i>
                     Pie Chart Dashboard
                    </div>
                    <div class="card-body">
                      <canvas id="myPieChart" width="100%" height="100"></canvas>
                    </div>
                    <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
                </div>
              </div>
          </div>
        </div>
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
              <div class="copyright text-center my-auto">
                <span>Copyright © Your Website 2019</span>
              </div>
          </div>
        </footer>
    </div>
    <!-- /.content-wrapper -->
  </div>

  <script>
  // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Blue", "Red", "Yellow", "Green"],
    datasets: [{
      data: [12.21, 15.58, 11.25, 8.32],
      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});

  </script>