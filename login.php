<?php

include_once ('./system/user_default.php');
include_once ('./style/php/style.php');
include_once ('./system/routines/php/secure.php');
include_once ('./system/routines/php/routines.php');
include_once ('./system/routines/php/anagrafica.php');

log_bootstrap($_POST);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title></title>
  <link rel="stylesheet" href="./style/css/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="./style/css/vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="./style/css/style.css">
  <link rel="shortcut icon" href="./style/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="./style/images/logo.png" alt="logo">
              </div>
              <h4>Benvenuto!</h4>
              <h6 class="font-weight-light">Effettua il login per continuare.</h6>
              <form class="pt-3" method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                </div>
                <input type='hidden' name='action' value="login" />
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                      <i class="mdi mdi-account"></i>
                      Login
                </button>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <!--<div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Ricordami
                    </label>
                  </div>-->
                  <!--<a href="#" class="auth-link text-black">Forgot password?</a>-->
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="./style/css/vendors/base/vendor.bundle.base.js"></script>
  <script src="./system/routines/js/lib/off-canvas.js"></script>
  <script src="./system/routines/js/lib/hoverable-collapse.js"></script>
  <script src="./system/routines/js/lib/template.js"></script>
</body>

</html>
