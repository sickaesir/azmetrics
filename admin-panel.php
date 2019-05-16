<?php
include_once('./inc/inc.php');
if(if_not_logged_in(function() {
  redirect('login.php');
}));

if(!is_admin(get_logged_in_user())) {
  redirect('metrics.php');
}


if(isset($_GET['action'])) {
  switch($_GET['action']) {
    case 'revoke_admin':
    if(!isset($_GET['user_id']))
    redirect('admin-panel.php');

    set_admin(intval($_GET['user_id']), false);
    redirect('admin-panel.php');
    break;

    case 'grant_admin':
    if(!isset($_GET['user_id']))
    redirect('admin-panel.php');


    set_admin(intval($_GET['user_id']), true);
    redirect('admin-panel.php');
    break;

    default: break;
  }
}


$users_query = get_users(isset($_GET['search_query']) ? $_GET['search_query'] : '');

$page = 0;

if(isset($_GET['page']) && intval($_GET['page']) !== 0) {
  $page = intval($_GET['page']);
}

$users = $users_query[$page];


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>:: AzMetrics - Admin Panel ::</title>
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
              <div class="text-center mt-5">
                <h3>User Management</h3>
              </div>


              <table class="table mt-5">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">
                      <div class="row">
                        <div class="col-lg-2">Email</div>
                        <div class="col-lg-4">

                          <form action="admin-panel.php" method="GET">
                            <div class="form-group">
                              <input type="text" class="form-control" name="search_query" placeholder="Search by email...">
                            </div>
                          </form>
                        </div>
                      </div>
                    </th>
                    <th scope="col">Admin</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach($users as $user) {
                    ?>
                    <tr>
                      <th scope="row"><?=$user['id']?></th>
                      <td><?=$user['email']?></td>
                      <td><?=(is_admin($user['id']) ? 'Yes' : 'No' )?></td>
                      <td>
                        <a href="admin-panel.php?user_id=<?=$user['id']?>&action=<?=(is_admin($user['id']) ? 'revoke_admin' : 'grant_admin')?>" class="btn btn-sm btn-<?=(is_admin($user['id']) ? 'danger' : 'success')?>"><?=(is_admin($user['id']) ? 'Revoke Admin' : 'Grant Admin')?></a>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="mt-5 py-5 border-top text-center justify-content-center">
              <div class="row justify-content-center">
                <div class="col-lg-9">
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">

                      <?php if($page !== 0): ?>
                        <li class="page-item">
                          <a class="page-link" href="admin-panel.php?page=<?=($page - 1)?>" aria-label="Previous">
                            <i class="fa fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                      <?php endif; ?>

                      <?php for($i = 0; $i < count($users_query); $i++): ?>
                        <?php if($i === $page) continue; ?>
                        <li class="page-item"><a class="page-link b" href="admin-panel.php?page=<?=$i?>"><?=$i?></a></li>
                      <?php endfor;?>

                      <?php if($page !== count($users_query) - 1): ?>
                        <li class="page-item">
                          <a class="page-link" href="admin-panel.php?page=<?=($page + 1)?>" aria-label="Next">
                            <i class="fa fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                      <?php endif; ?>
                    </ul>
                  </nav>
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
