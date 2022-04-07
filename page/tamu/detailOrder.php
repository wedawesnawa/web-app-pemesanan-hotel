<?php
    $data = $dtp->select_join("tb_pelanggan","tb_reservasi","id_pelanggan", $_GET['id']);
    $data1 = $dtp->selectWhere("tb_reservasi","id_pelanggan", $_GET['id']);
    $data2 = $dtp->getCountRows("tb_order_kamar", "id_reservasi", $data1['id_reservasi']);
    $data3 = $dtp->selectWhere("tb_kategori", "id_kategori", $data['id_kategori']);

    if(isset($_GET['selesai'])){
        $dtp->logout();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Da Hotel</title>
    <!-- BS Stepper -->
    <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">

         <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-gray">
            <div class="container">
                <a href="index3.html" class="navbar-brand">
                    <span class="brand-text font-weight-light">Data Reservasi</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <a href="" class="btn btn-primary" id="btdelete">Selesai</a>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper bg-white">

            <!-- Main content -->
            <div class="content">           
                <div class="container">
                    <div class="card my-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10 ml-3 py-2 my-3">
                                    <div class="row-sm-12 d-flex ml-3 pt-3">
                                        <div class="col-md-2 px-0">Nama Tamu</div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" class="form-control" value="<?=$data['nama_tamu'];?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row-sm-12 d-flex ml-3 pt-3">
                                        <div class="col-md-2 px-0">Cek In</div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" class="form-control" value="<?=$data['cek_in'];?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row-sm-12 d-flex ml-3 pt-3">
                                        <div class="col-md-2 px-0">Cek Out</div>
                                        <div class="col-md-8 form-group"> 
                                            <input type="email" class="form-control" value="<?=$data['cek_out'];?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row-sm-12 d-flex ml-3 pt-3">
                                        <div class="col-md-2 px-0">Type Kamar</div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" class="form-control" value="<?=$data3['nama_kategori'];?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row-sm-12 d-flex ml-3 pt-3">
                                        <div class="col-md-2 px-0">Jumlah Kamar</div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" class="form-control" value="<?=$data2;?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?page=print&print&kd=<?=$_GET['id']?>" class="btn btn-default float-right" rel="noopener" target="_blank"><i class="fas fa-print"></i> Print</a>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- BS-Stepper -->
    <script src="plugins/jquery-3.2.1.min.js"></script>
    <script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })
        })
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
    </script>
     <script>
        $(document).ready(function(){
            $("#btdelete").click(function(e){
                e.preventDefault();
                swal({
                    title: "Selesai",
                    text: "Yakin Selesai ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {
                    window.location.href="index.php?page=orderdetail&selesai&id=<?=$_GET['id']?>";
                    }
                });
            });
        })
    </script>
</body>
</html>