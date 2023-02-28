<?php

include_once ('./system/user_default.php');
include_once ('./style/php/style.php');
include_once ('./system/routines/php/secure.php');
include_once ('./system/routines/php/routines.php');
include_once ('./system/routines/php/anagrafica.php');
include_once ('./system/routines/php/menu.php');
include_once ('./system/routines/php/dispositivi.php');

log_bootstrap();

?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php print $title ?></title>
    <?php print get_content("header"); ?>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style>
    #map
    {
      height: 400px;
      width: 100%;
    }
    </style>
</head>
<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <a class="navbar-brand brand-logo" href="index.php"><img src="<?php print $logo ?>" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="<?php print $logo ?>" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown" aria-expanded="true">
              <img src="<?php print $logo_quadrato ?>" alt="profile"/>
              <span class="nav-profile-name"><?php $user = get_user_from_uid($uid); print $user["nome"] . " " . $user["cognome"]; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a href="./logout.php" class="dropdown-item">
                    <i class="mdi mdi-logout text-primary"></i>
                    Logout
                </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <?php
            $tid = get_tid_from_uid($uid);
            $menu = get_menu_from_tid($tid);
            for($i=0;$i<count($menu);$i++)
            {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php print $menu[$i]["path"]; ?>">
                <i class="mdi <?php print $menu[$i]["mdi"]; ?> menu-icon"></i>
                <span class="menu-title"><?php print $menu[$i]["titolo"]; ?></span>
              </a>
            </li>
          <?php
            }
            ?>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
						<div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Mappa</h4>
                  <div id="map"></div>
                </div>
              </div>
						</div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Statistica</h4>
                  <div id="statistiche-data-label" class="d-flex justify-content-center pt-3"></div>
                  <canvas id="statistiche-data"></canvas>
                </div>
              </div>
						</div>
					</div>
        <div class="row">
          <div class="col-md-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Rilevazioni</p>
                <div class="table-responsive">
                  <table id="order-listing" class="table">
                    <thead>
                      <tr>
                          <th>Id Dispositivo</th>
                          <th>Concentrazione polveri sottili</th>
                          <th>Monossido di carbonio</th>
                          <th>Diossido di azoto</th>
                          <th>Anidride solforosa</th>
                          <th>Ozono al livello del suolo</th>
                          <th>Timestamp</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dispositivi = get_rilevazioni();
                        for($i=0;$i<count($dispositivi);$i++)
                        {
                        ?>
                        <tr>
                            <td><?php print $dispositivi[$i]["idd"]; ?></td>
                            <td><?php print $dispositivi[$i]["pm"]; ?></td>
                            <td><?php print $dispositivi[$i]["CO"]; ?></td>
                            <td><?php print $dispositivi[$i]["NO2"]; ?></td>
                            <td><?php print $dispositivi[$i]["SO2"]; ?></td>
                            <td><?php print $dispositivi[$i]["O3"]; ?></td>
                            <td><?php print date('d/m/Y H:m:s', $dispositivi[$i]['timestamp']); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <?php print get_content("footer"); ?>
          </div>
        </footer>
        </div>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

<?php print get_content("footer_script"); ?>
<script>
  <?php
      $labels = "[";
      $pm = "[";
      $CO = "[";
      $NO2 = "[";
      $SO2 = "[";
      $O3 = "[";
      for($i=1;$i<=count($dispositivi);$i++)
      {
          $labels .= "".$dispositivi[$i]['timestamp'].",";
          $pm .= $dispositivi[$i]["pm"].",";
          $CO .= $dispositivi[$i]["CO"].",";
          $NO2 .= $dispositivi[$i]["NO2"].",";
          $SO2 .= $dispositivi[$i]["SO2"].",";
          $O3 .= $dispositivi[$i]["O3"].",";

      }
      $pm .= "]";
      $CO .= "]";
      $NO2 .= "]";
      $SO2 .= "]";
      $O3 .= "]";
      $labels .= "]";
  ?>
  var ctx = document.getElementById('statistiche-data').getContext('2d');
  var myChart = new Chart(ctx, {
  type: 'line',
  data: {
          labels: <?php print $labels; ?>,
          datasets: [{
              label: 'Pm',
              data: <?php print $pm; ?>,
              backgroundColor: [
                  'rgba(0,200,0, 0)'
              ],
              borderColor: [
                  'rgba(0,200,0, 1)'
              ],
              borderWidth: 1
          },
          {
              label: 'CO',
              data: <?php print $CO; ?>,
              backgroundColor: [
                  'rgba(255, 0, 0, 0)'
              ],
              borderColor: [
                  'rgba(255, 0, 0, 1)'
              ],
              borderWidth: 1
          },
          {
              label: 'NO2',
              data: <?php print $NO2; ?>,
              backgroundColor: [
                  'rgba(0,155,0, 0)'
              ],
              borderColor: [
                  'rgba(0,155,0, 1)'
              ],
              borderWidth: 1
          },
          {
              label: 'SO2',
              data: <?php print $SO2; ?>,
              backgroundColor: [
                  'rgba(255, 0, 200, 0)'
              ],
              borderColor: [
                  'rgba(255, 0, 200, 1)'
              ],
              borderWidth: 1
          },
          {
              label: 'O3',
              data: <?php print $O3; ?>,
              backgroundColor: [
                  'rgba(255, 200, 0, 0)'
              ],
              borderColor: [
                  'rgba(255, 200, 0, 1)'
              ],
              borderWidth: 1
          }
          ]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBp9X8I6p1y9EAPucB3NN08wgyP6d6JWLY&callback=initMap&v=weekly" defer></script>
  <script>
  function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 10,
      center: { lat: 42.3959942, lng: 11.1958989 },
    });
    <?php
    $dispositivi = get_dispositivi();
    for($i=0;$i<count($dispositivi);$i++)
    {
    ?>
    var pin = { lat: <?php print $dispositivi[$i]["coord_x"]; ?>, lng: <?php print $dispositivi[$i]["coord_y"]; ?> };
    var marker = new google.maps.Marker({
      position: pin,
      map: map,
    });
    <?php
    }
    ?>

  }

  window.initMap = initMap;
  </script>
</body>

</html>
