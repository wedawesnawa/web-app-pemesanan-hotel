<?php
    $pm = $dtk->getCountRow("tb_foto_kamar");
    $pp = $dtk->getCountRow("tb_foto_hotel");
    $ps = $dtk->getCountRow("tb_fasilitas_kamar");
    $tm = $dtk->getCountRow("tb_fasilitas_hotel");
    $lk = $dtk->getCountRow("tb_lokasi");
    $kt = $dtk->getCountRow("tb_kategori");
    $kr = $dtk->getCountRows("tb_kamar","id_kategori", "KT001");
    $kd = $dtk->getCountRows("tb_kamar","id_kategori", "KT002");
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
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-image"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Foto Kamar</span>
                                <span class="info-box-number">
                                <?=$pm;?>
                                </span>
                            </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-images"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Foto Hotel</span>
                                <span class="info-box-number"><?=$pp;?></span>
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
                            <span class="info-box-icon bg-maroon elevation-1"><i class="fas fa-list"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Fasilitas Kamar</span>
                                <span class="info-box-number"><?=$ps;?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-list-ol"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Fasilitas Hotel</span>
                                <span class="info-box-number"><?=$tm;?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-teal elevation-1"><i class="fas fa-door-open"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Kamar Superior</span>
                                <span class="info-box-number">
                                <?=$kr;?>
                                </span>
                            </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-door-closed"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Kamar Deluxe</span>
                                <span class="info-box-number"><?=$kd;?></span>
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
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-map-pin"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Landmark</span>
                                <span class="info-box-number"><?=$lk;?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-indigo elevation-1"><i class="fas fa-archway"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Tipe</span>
                                <span class="info-box-number"><?=$kt;?></span>
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