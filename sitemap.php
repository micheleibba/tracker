<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/user_default.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/style/php/style.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/secure.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/routines.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/anagrafica.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/menu.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . './tracker/system/routines/php/sitemap.php');

log_bootstrap();

if(!$_POST["smid"])
{
    prevent_refresh_submit(save_sitemap($_POST)["error"]);
}
else
{
    edit_sitemap($_POST);
}

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php print $title ?></title>
    <?php print get_content("header"); ?>
    <script src="./system/routines/js/sitemap.js"></script>
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
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?php print $logo_quadrato ?>" alt="profile"/>
              <span class="nav-profile-name"><?php $user = get_user_from_uid($uid); print $user["nome"] . " " . $user["cognome"]; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <!--<a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>-->
              <a class="dropdown-item" href="./logout.php">
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
              <a class="nav-link" href="<?php print $menu[$i]["path"]?>">
                <i class="mdi <?php print $menu[$i]["mdi"]?> menu-icon"></i>
                <span class="menu-title"><?php print $menu[$i]["titolo"]?></span>
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
          <div id="sitemap-container" class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Nuova Pagina</h4>
                  <form class="form-sample" method="post" action="" enctype="multipart/form-data">
                    <p class="card-description">
                      Aggiungi pagina
                    </p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Nome pagina</label>
                              <div class="col-sm-9">
                                <input type="text" id="titolo" name="titolo" class="form-control" value="" />
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Path</label>
                              <div class="col-sm-9">
                                <input type="text" id="path" name="path" class="form-control" value="" />
                              </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="smid" name="smid" value="0">
                    <button type="submit" value="submit" class="btn btn-primary mr-2">Salva</button>
                </form>

                </div>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Sitemap</p>
                <div class="table-responsive">
                  <table id="order-listing" class="table table-hover">
                    <thead>
                      <tr>
                          <th>Nome</th>
                          <th>Path</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sitemap = get_sitemap();
                        for($i=0;$i<count($sitemap);$i++)
                        {
                        ?>
                        <tr>
                            <td><?php print $sitemap[$i]["titolo"]; ?></td>
                            <td><?php print $sitemap[$i]["path"]; ?></td>
                            <td class="td-button-center">
                                <button onclick="gotoLink('#sitemap-container');editSitemap(<?php print $sitemap[$i]["smid"]; ?>);" type="button" class="btn btn-primary btn-icon-text">
                                    <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                    Modifica
                                </button>
                            </td>
                            <td class="td-button-center">
                                <button onclick="deleteSitemap(<?php print $sitemap[$i]["smid"] ?>);" type="button" class="btn btn-danger btn-icon-text">
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
        <div id="task-container" class="row" style="display:none;">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">TASK DEL SERVIZIO: <span id="task-title"  class="text-primary mb-0 hover-cursor"></span></h4>
                    <form id="task-form" class="form-sample" method="post" action="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <button onclick="addNewTask();" type="button" class="btn btn-success btn-icon-text">
                                            <i class="mdi mdi-plus btn-icon-prepend"></i>
                                            Aggiungi task
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="task-dynamic-container">

                        </div>
                        <button onclick="addTask();" id="task-button" type="button" class="btn btn-primary mr-2" disabled="disabled">Salva</button>
                    </form>
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
