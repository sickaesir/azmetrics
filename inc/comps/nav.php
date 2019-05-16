<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
  <div class="container">
    <a class="navbar-brand mr-lg-5" href="../index.html">
      <img src="img/logo.png">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="navbar_global">
      <div class="navbar-collapse-header">
        <div class="row">
          <div class="col-6 collapse-brand">
            <a href="../index.html">
              <img src="assets/img/brand/blue.png">
            </a>
          </div>
          <div class="col-6 collapse-close">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>
      <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
        <li class="nav-item dropdown">
          <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
            <i class="ni ni-ui-04 d-lg-none"></i>
            <span class="nav-link-inner--text">Menu</span>
          </a>
          <div class="dropdown-menu dropdown-menu-xl">
            <div class="dropdown-menu-inner">
              <a href="metrics.php" class="media d-flex align-items-center">
                <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                  <i class="ni ni-spaceship"></i>
                </div>
                <div class="media-body ml-3">
                  <h6 class="heading text-primary mb-md-1">Metrics</h6>
                  <p class="description d-none d-md-inline-block mb-0">Check your metrics</p>
                </div>
              </a>
              <?php if(is_admin(get_logged_in_user())): ?>
              <a href="admin-panel.php" class="media d-flex align-items-center">
                <div class="icon icon-shape bg-gradient-warning rounded-circle text-white">
                  <i class="ni ni-ui-04"></i>
                </div>
                <div class="media-body ml-3">
                  <h5 class="heading text-warning mb-md-1">Admin Control Panel</h5>
                  <p class="description d-none d-md-inline-block mb-0">Browse our 50 beautiful handcrafted components offered in the Free version.</p>
                </div>
              </a>
              <?php endif; ?>
            </div>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav align-items-lg-center ml-lg-auto">
        <li class="nav-item">
          <a class="nav-link nav-link-icon" href="https://github.com/sickaesir/azmetrics" target="_blank" data-toggle="tooltip" title="Star us on Github">
            <i class="fa fa-github"></i>
            <span class="nav-link-inner--text d-lg-none">Github</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
