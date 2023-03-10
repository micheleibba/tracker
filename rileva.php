<?php

include_once ('./system/user_default.php');
include_once ('./style/php/style.php');
include_once ('./system/routines/php/secure.php');
include_once ('./system/routines/php/routines.php');
include_once ('./system/routines/php/anagrafica.php');
include_once ('./system/routines/php/menu.php');
include_once ('./system/routines/php/dispositivi.php');

log_bootstrap();


if(!$_POST["idr"])
{
    prevent_refresh_submit(aggiungi_rilevazione($_POST, $_POST["tid"])["error"]);
}


?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php print $title ?></title>
    <?php print get_content("header"); ?>
    <script src="./system/routines/js/dispositivi.js"></script>
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
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Nuova Rilevazione</h4>
                  <form class="form-sample" method="post" action="" enctype="multipart/form-data">
                    <p class="card-description">
                      Aggiungi Rilevazione
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Id Dispositivo</label>
                          <div class="col-sm-9">
                            <select class="card-standard-select" id="idd" name="idd">
                            <?php
                            $dispositivi = get_dispositivi();
                            for($i=0;$i<count($dispositivi);$i++)
                            {
                            ?>
                                  <option value="<?php print $dispositivi[$i]["idd"]; ?>"><?php print $dispositivi[$i]["nome"]; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Concentrazione polveri sottili</label>
                            <div class="col-sm-9">
                              <input type="text" id="pm" name="pm" class="form-control" value="" />
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Monossido di carbonio</label>
                          <div class="col-sm-9">
                            <input type="text" id="CO" name="CO" class="form-control" value="" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Diossido di azoto</label>
                          <div class="col-sm-9">
                            <input type="text" id="NO2" name="NO2" class="form-control" value="" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Anidride solforosa</label>
                          <div class="col-sm-9">
                            <input type="text" id="SO2" name="SO2" class="form-control" value="" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Ozono al livello del suolo</label>
                          <div class="col-sm-9">
                            <input type="text" id="O3" name="O3" class="form-control" value="" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Timestamp</label>
                          <div class="col-sm-9">
                            <input type="text" id="timestamp" name="timestamp" class="form-control" value="" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" id="idr" name="idr" value="0">
                    <button type="submit" value="submit" class="btn btn-primary mr-2">Salva</button>
                  </form>

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
                          <th></th>
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
                            <td><?php print $dispositivi[$i]["timestamp"]; ?></td>
                            <td class="td-button-center">
                                <button onclick="deleteRilevazione(<?php print $dispositivi[$i]["idr"] ?>);" type="button" class="btn btn-danger btn-icon-text">
                                      <i class="mdi mdi-delete btn-icon-prepend"></i>
                                      Elimina
                                </button>
                            </td>
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
</body>

</html>
