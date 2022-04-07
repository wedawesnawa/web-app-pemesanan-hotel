<?php
    $rp = $dtr->getCountRows("tb_reservasi","status", "proses");
    $rs = $dtr->getCountRows("tb_reservasi","status", "selesai");
    $lp = $dtr->getCountRow("tb_pelanggan");
    $lr = $dtr->getCountRow("tb_reservasi");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 </title>
</head>
<body>
    <div class="wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-spinner"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Reservasi Proses</span>
                                <span class="info-box-number"><?=$rp;?></span>
                            </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-hourglass-end"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Reservasi Selesai</span>
                                <span class="info-box-number"><?=$rs;?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-maroon elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Pelanggan</span>
                                <span class="info-box-number"><?=$lp;?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Reservasi</span>
                                <span class="info-box-number"><?=$lr;?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </section>
    </div>
</body>
</html>