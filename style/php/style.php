<?php

//error_reporting(0);
//session_start();

function get_content($id)
{
    global $title;
    global $_SESSION;
    global $copyright_footer;

    $html = "";
    if($id === "header")
    {
        $html = '
                <script src="./system/routines/js/webside.js"></script>
                <link rel="stylesheet" href="./style/css/vendors/mdi/css/materialdesignicons.min.css">
                <link rel="stylesheet" href="./style/css/vendors/css/vendor.bundle.base.css">
                <link rel="stylesheet" href="./style/css/vendors/dropzone/dropzone.css">
                <link rel="stylesheet" href="./style/css/vendors/font-awesome/css/font-awesome.min.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-bar-rating/bars-1to10.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-bar-rating/bars-horizontal.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-bar-rating/bars-movie.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-bar-rating/bars-pill.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-bar-rating/bars-reversed.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-bar-rating/bars-square.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-bar-rating/bootstrap-stars.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-bar-rating/css-stars.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-bar-rating/examples.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-bar-rating/fontawesome-stars-o.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-bar-rating/fontawesome-stars.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-asColorPicker/css/asColorPicker.min.css">
                <link rel="stylesheet" href="./style/css/vendors/x-editable/bootstrap-editable.css">
                <link rel="stylesheet" href="./style/css/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
                <link rel="stylesheet" href="./style/css/vendors/dropify/dropify.min.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-file-upload/uploadfile.css">
                <link rel="stylesheet" href="./style/css/vendors/jquery-tags-input/jquery.tagsinput.min.css">
                <link rel="stylesheet" href="./style/css/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css">
                <link rel="stylesheet" href="./style/css/style.css">
                <link rel="stylesheet" href="./style/css/style_integration.css">
                <link rel="stylesheet" href="./style/css/bootstrap-select.css">
                <link rel="stylesheet" href="./style/css/vendors/select2/select2.min.css">
                <link rel="stylesheet" href="./style/css/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
                <link rel="stylesheet" href="./style/css/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    ';
    }
    if($id === "footer")
    {
      $html = '<span class="text-muted text-center text-sm-left d-block d-sm-inline-block">'.$copyright_footer.'</span>';
    }
    if($id === "footer_script")
    {
        $html = '
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
                <script src="./style/css/vendors/chart.js/Chart.min.js"></script>
                <!--<script src="./style/css/vendors/js/vendor.bundle.base.js"></script>-->
                <script src="./style/css/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
                <script src="./style/css/vendors/jquery-asColor/jquery-asColor.min.js"></script>
                <script src="./style/css/vendors/jquery-asGradient/jquery-asGradient.min.js"></script>
                <script src="./style/css/vendors/jquery-asColorPicker/jquery-asColorPicker.min.js"></script>
                <script src="./style/css/vendors/x-editable/bootstrap-editable.min.js"></script>
                <script src="./style/css/vendors/moment/moment.min.js"></script>
                <script src="./style/css/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js"></script>
                <script src="./style/css/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
                <script src="./style/css/vendors/dropify/dropify.min.js"></script>
                <script src="./style/css/vendors/jquery-file-upload/jquery.uploadfile.min.js"></script>
                <script src="./style/css/vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>
                <script src="./style/css/vendors/dropzone/dropzone.js"></script>
                <script src="./style/css/vendors/jquery.repeater/jquery.repeater.min.js"></script>
                <script src="./style/css/vendors/inputmask/jquery.inputmask.bundle.js"></script>
                <script src="./style/css/vendors/typeahead.js/typeahead.bundle.min.js"></script>
                <script src="./style/css/vendors/select2/select2.min.js"></script>
                <script src="./style/css/vendors/datatables.net/jquery.dataTables.js"></script>
                <script src="./style/css/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
                <script src="./style/css/vendors/sweetalert/sweetalert.min.js"></script>
                <script src="./style/css/vendors/jquery.avgrund/jquery.avgrund.min.js"></script>

                <script src="./system/routines/js/lib/off-canvas.js"></script>
                <script src="./system/routines/js/lib/hoverable-collapse.js"></script>
                <script src="./system/routines/js/lib/template.js"></script>
                <script src="./system/routines/js/lib/settings.js"></script>
                <script src="./system/routines/js/lib/todolist.js"></script>
                <script src="./system/routines/js/lib/formpickers.js"></script>
                <script src="./system/routines/js/lib/form-addons.js"></script>
                <script src="./system/routines/js/lib/x-editable.js"></script>
                <script src="./system/routines/js/lib/dropify.js"></script>
                <script src="./system/routines/js/lib/dropzone.js"></script>
                <script src="./system/routines/js/lib/jquery-file-upload.js"></script>
                <script src="./system/routines/js/lib/formpickers.js"></script>
                <script src="./system/routines/js/lib/form-repeater.js"></script>
                <script src="./system/routines/js/lib/inputmask.js"></script>
                <script src="./system/routines/js/lib/bootstrap-select.js"></script>
                <script src="./system/routines/js/lib/file-upload.js"></script>
                <script src="./system/routines/js/lib/typeahead.js"></script>
                <script src="./system/routines/js/lib/select2.js"></script>
                <script src="./system/routines/js/lib/data-table.js"></script>
                <script src="./system/routines/js/lib/alerts.js"></script>
                <script src="./system/routines/js/lib/avgrund.js"></script>
                ';
    }
    return $html;
}
