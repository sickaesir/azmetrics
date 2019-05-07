  <?php
  include_once('./inc/inc.php');


  if(if_not_logged_in(function() {
    redirect('login.php');
  }));

  if(!isset($_GET['metric_id']))
  {
    redirect('metrics.php');
  }

  $metric_id = intval($_GET['metric_id']);

  $metric = get_metric($metric_id);

  if($metric['user_id'] !== get_logged_in_user() && !is_admin(get_logged_in_user())) {
    redirect('metrics.php');
  }

  if(isset($_GET['action']))
  {
    switch($_GET['action'])
    {
      default: redirect('metrics.php'); break;
      case 'delete':
      delete_metric($metric['id']);
      redirect('metrics.php');
      break;

      case 'gen_app_key':
      set_app_key($metric['id'], generate_random_string(32));
      redirect("metric.php?metric_id=$metric_id");
      break;

      case 'del_app_key':
      set_app_key($metric['id'], null);
      redirect("metric.php?metric_id=$metric_id");
      break;
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
                <div class="col-lg-3 order-lg-2 justify-content-center">
                  <div class="card-profile-stats d-flex justify-content-center">
                    <div>
                      <span class="heading">Application Key</span>

                      <?php if(isset($metric['app_key'])): ?>
                        <div class="mt-lg-1">
                          <span class="description"><?=$metric['app_key']?></span>
                        </div>
                        <div class="mt-lg-1">
                          <a href="metric.php?action=del_app_key&metric_id=<?=$metric['id']?>" class="btn btn-sm btn-danger">Delete Key</a>
                        </div>
                      <?php else: ?>
                        <div class="mt-lg-1">
                          <a href="metric.php?action=gen_app_key&metric_id=<?=$metric['id']?>" class="btn btn-sm btn-primary">Generate Key</a>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                  <div class="card-profile-actions py-4 mt-lg-0">
                    <a href="metric.php?action=delete&metric_id=<?=$metric['id']?>" class="btn btn-sm btn-danger mr-4">Delete</a>
                    <?php if(isset($metric['app_key'])): ?>
                      <a href="#!" data-toggle="modal" data-target="#modal-form" class="btn btn-sm btn-primary mr-4">Add Data</a>
                    <?php endif; ?>
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
                <h3><?=$metric['name']?></h3>
                <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i></div>
                <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>placeholder</div>
                <div><i class="ni education_hat mr-2"></i>placeholder</div>
              </div>
              <div class="mt-5 py-5 border-top text-center">
                <div class="row justify-content-center">
                  <div class="col-lg-9">
                    <?php if(isset($metric['app_key'])): ?>
                      <canvas id="metric-chart"></canvas>
                    <?php else: ?>
                      <p class="text-danger">For genearate a chart you need to generate an application id!</p>
                    <?php endif; ?>
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

    <?php if(isset($metric['app_key'])): ?>


      <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
          <div class="modal-content">

            <div class="modal-body p-0">


              <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4">
                    <small>Add metric value</small>
                  </div>
                    <div class="form-group mb-3">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-number-83"></i></span>
                        </div>
                        <input id="metric-add-modal-value" class="form-control" placeholder="Value" type="number">
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="button" class="btn btn-primary my-4" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-success my-4" data-dismiss="modal" onclick="on_add_metric_click()">Add</button>
                    </div>
                </div>
              </div>



            </div>

          </div>
        </div>
      </div>


      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
      <script>

      function on_add_metric_click() {
        $.ajax({
          url: 'metric_api.php?action=ingest&app_key=<?=$metric['app_key']?>&value=' + $('#metric-add-modal-value').val(),
          dataType: 'json'
        });
      }
      var ctx = document.getElementById('metric-chart').getContext('2d');
      var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
          labels: [],
          datasets: [{
            label: 'Loading dataset...',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: []
          }]
        },

        // Configuration options go here
        options: {}
      });

      setInterval(function() {
        $.ajax({
          url: 'metric_api.php?action=retrieve&app_key=<?=$metric['app_key']?>',
          dataType: 'json'

        }).done(function(data) {

          chart.config.data.labels = [];
          chart.config.data.datasets.forEach((dataset) => {
            dataset.data = [];
          });
          var labels = [];
          var dataset_data = [];
          for(var i = 0; i < data.data.length; i++) {
            labels.push(data.data[i].ingested_on);
            dataset_data.push(data.data[i].value);
          }

          chart.config.data.labels = labels;
          chart.config.data.datasets.forEach((dataset) => {
            dataset.data = dataset_data;
            dataset.label = 'Metric value'
          });

          chart.update();
        });
      }, 1000);
      <?php endif; ?>
      </script>
    </body>

    </html>
