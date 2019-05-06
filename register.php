<?php
include_once('./inc/inc.php');

if_logged_in(function() {
  redirect('user-panel.php');
});

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_repeat']))
{
  $res = make_register($_POST['email'], $_POST['password'], $_POST['password_repeat']);

  if($res !== true)
  $err = $res;
  else
  redirect('login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>:: AzMetrics - Register ::</title>
  <!-- Favicon -->
  <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="assets/css/argon.css?v=1.0.1" rel="stylesheet">
</head>

<body>
  <header class="header-global">
    <?php include_once('./inc/comps/nav.php'); ?>
  </header>
  <main>
    <section class="section section-shaped section-lg">
      <div class="shape shape-style-1 bg-gradient-default">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="container pt-lg-md">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="card bg-secondary shadow border-0">
              <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                  <small>New Account</small>
                </div>
                <form role="form" action="register.php" method="post">
                  <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                      </div>
                      <input class="form-control" placeholder="Email" type="email" name="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="Password" type="password" name="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="Repeat Password" type="password" name="password_repeat">
                    </div>
                  </div>

                  <?php if(isset($err)): ?>
                    <div class="text-center">
                      <p class="text-danger"><?=$err?></p>
                    </div>
                  <?php endif; ?>
                  <div class="text-center">
                    <input type="submit" class="btn btn-primary my-4" value="Register" />
                  </div>
                </form>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12 text-center">
                <a href="login.php" class="text-light">
                  <small>Already have an account?</small>
                </a>
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
