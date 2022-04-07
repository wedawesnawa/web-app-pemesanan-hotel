<?php
    session_start();
    include "config/kontrol.php";
    $dtk = new pesan();
    $auth = $dtk->AuthUser("tb_user",$_SESSION['username']);
    $response = $dtk->sessionCheck();

    if ($response == "false") {
    header("Location:loginMulti.php");
    }
    if(isset($_GET['logout'])){
        $dtk->logout2();
    }
    @$page = $_GET['page'];
    if($page=='dtakamar'){
        $activedta = "menu-open";
        $activedta1 = "active";
        $activedtakmr = "active";
    }
    else if($page == 'dtahotel'){
        $activedta = "menu-open";
        $activedta1 = "active";
        $activedtahtl = "active";
    }
    else if($page == 'addfhotel'){
        $activedta = "menu-open";
        $activedta1 = "active";
        $activedtahtl = "active";
    }
    else if($page == 'addfasilitas'){
        $activedta = "menu-open";
        $activedta1 = "active";
        $activedtahtl = "active";
    }
    else if($page == 'detailkamar'){
        $activedta = "menu-open";
        $activedta1 = "active";
        $activedtakmr = "active";
    }
    else if($page == 'editkamar'){
        $activedta = "menu-open";
        $activedta1 = "active";
        $activedtakmr = "active";
    }
    else if($page == 'editfotokamar'){
        $activedta = "menu-open";
        $activedta1 = "active";
        $activedtakmr = "active";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Da Hotel | Dashboard</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href=" plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href=" plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="plugins/dropify/dist/css/dropify.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/css/sweet-alert.css">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed bg-white">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
    </nav>
    
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="pageAdmin.php?page=board" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Da Hotel</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a class="d-block"><?=$auth['username']?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="pageAdmin.php" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item <?=$activedta?>">
                    <a href="#" class="nav-link <?=$activedta1?>">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pageAdmin.php?page=dtakamar" class="nav-link <?=$activedtakmr?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kamar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pageAdmin.php?page=dtahotel" class="nav-link <?=$activedtahtl?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Hotel</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">LOGOUT</li>
                <li class="nav-item">
                    <a id="forLogout" href="" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
                <script src="plugins/jquery-3.2.1.min.js"></script>
                <script>
                    $(document).ready(function(){
                        $('#forLogout').click(function(e){
                            e.preventDefault();
                            swal({
                                title: "Logout",
                                text: "Yakin Logout?",
                                type: "info",
                                showCancelButton: true,
                                confirmButtonText: "Yes",
                                cancelButtonText: "No",
                                closeOnConfirm: false,
                                closeOnCancel: true
                                }, function(isConfirm) {
                                if (isConfirm) {
                                window.location.href="pageAdmin.php?logout";
                                }
                            });
                        });
                    })
                </script>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?php
                    @$page = $_GET['page'];
                    switch ($page){
                        case 'dtakamar':
                            include 'page/admin/dataKamar.php';
                            break;
                        case 'detailkamar':
                            include 'page/admin/detailKamar.php';
                            break;
                        case 'editkamar':
                            include 'page/admin/editDataKamar.php';
                            break;
                        case 'editfotokamar':
                            include 'page/admin/editFotoKamar.php';
                            break;
                        case 'dtahotel':
                            include 'page/admin/dataHotel.php';
                            break;
                        case 'addfasilitas':
                            include 'page/admin/addFasilitas.php';
                            break;
                        case 'addfhotel':
                            include 'page/admin/addFotoHotel.php';
                            break;
                        default:
                            $page = "dashboard";
                            include "page/admin/dashboard.php";
                            break;
                    };                
                ?>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
        </div>
    </footer>
    <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- BS-Stepper -->
    <script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <!-- dropzonejs -->
    <script src="plugins/dropzone/min/dropzone.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script src="plugins/dropify/dist/js/dropify.min.js"></script>
     <!-- bs-custom-file-input -->
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="dist/js/sweetalert.min.js"></script>
    <script>
        $(function () {
        bsCustomFileInput.init();
        $('.dropify').dropify();
        });
    </script>
    <?php 
    error_reporting(0);
    include "config/alert.php";
    ?>
</body>
</html>