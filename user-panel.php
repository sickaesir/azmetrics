<?php
  include_once('./inc/inc.php');
  if(if_not_logged_in(function() {
    redirect('login.php');
  }));

  $user_info = get_user(get_logged_in_user());

  if($user_info === false)
  {
    die('fatal error, please contact an administrator.');
  }

  if(isset($_GET['action']))
  {
    switch($_GET['action'])
    {
      case 'logout':
        session_destroy();
        redirect('login.php');
        break;
      default: break;
    }
  }

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>:: AzMetrics - User Profile ::</title>
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
        <div class="card card-profile shadow mt--300">
          <div class="px-4">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="assets/img/theme/blank-profile-image.png" class="rounded-circle">
                  </a>
                </div>
              </div>
              <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                <div class="card-profile-actions py-4 mt-lg-0">
                  <a href="user-panel.php?action=logout" class="btn btn-sm btn-danger mr-4">Logout</a>
                </div>
              </div>
              <div class="col-lg-4 order-lg-1">
                <div class="card-profile-stats d-flex justify-content-center">
                  <div>
                    <span class="heading">0</span>
                    <span class="description">Active Metrics</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center mt-5">
              <h3><?=$user_info['email']?>
                <span class="font-weight-light"> (User Id: <?=$user_info['id']?>)</span>
              </h3>
              <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>placeholder</div>
              <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>placeholder</div>
              <div><i class="ni education_hat mr-2"></i>placeholder</div>
            </div>
            <div class="mt-5 py-5 border-top text-center">
              <div class="row justify-content-center">
                <div class="col-lg-9">
                  <p>placeholder</p>
                  <a href="#">Show more</a>
                </div>
              </div>
            </div>
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
