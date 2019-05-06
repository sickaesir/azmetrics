<?php
include_once('./inc/inc.php');


if(if_not_logged_in(function() {
  redirect('login.php');
}));


$page = intval(0);

if(isset($_GET['page']))
{
  $page = intval($_GET['page']);
}


$metrics = get_metrics(get_logged_in_user(), $page);

$display_metrics = [];

{
  $tmp = [];
  $cnt = 0;

  foreach($metrics as $metric) {
    array_push($tmp, $metric);
    if((++$cnt % 3) == 0) {
      array_push($display_metrics, $tmp);
      $tmp = [];
    }

  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>:: AzMetrics - Metrics ::</title>
  <!-- Favicon -->
  <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="assets/css/argon.css?v=1.0.1" rel="stylesheet">
  <!-- Docs CSS -->
  <link type="text/css" href="assets/css/docs.min.css" rel="stylesheet">
</head>

<body>
  <header class="header-global">
    <?php include_once('./inc/comps/nav.php'); ?>
  </header>
  <main class="profile-page">
    <section class="section-profile-cover section-shaped my-0">
      <!-- Circles background -->
      <div class="shape shape-style-1 shape-primary alpha-4">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!-- SVG separator -->
      <div class="separator separator-bottom separator-skew">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <?php
            if(count($display_metrics) == 0)
            {
              ?>
              <div class="row row-grid">

                <div class="col-lg-6 center">
                  <div class="card card-lift--hover shadow border-0">
                    <div class="card-body py-5">
                      <div class="icon icon-shape icon-shape-primary rounded-circle mb-4">
                        <i class="ni ni-check-bold"></i>
                      </div>
                      <h6 class="text-primary text-uppercase">No metrics!</h6>
                      <p class="description mt-3">Seems like you have no metrics to show. Create one to start.</p>
                      <a href="create-metric.php" class="btn btn-success mt-4">Create Metric</a>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
            else {
              foreach($display_metrics as $metric_group) {
                ?><div class="row row-grid"><?php

                foreach($metric_group as $metric) {
                  ?>

                  <?php
                }

                ?></div><?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php include_once('./inc/comps/footer.php'); ?>
  <!-- Core -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/popper/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="assets/vendor/headroom/headroom.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.0.1"></script>
</body>

</html>
