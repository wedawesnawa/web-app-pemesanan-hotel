<?php
    $data4 = $dtr->selectWhere2("tb_order_kamar","id_reservasi", @$_GET['kd']);     
    $data5 = $dtr->selectWhere("tb_reservasi","id_reservasi", @$_GET['kd']);
    if(isset($_GET['cek_in'])){
        foreach($data4 as $value){
            $idPelanggan = $data5['id_pelanggan'];
            $idK = $value['id'];
            $status_kamar = "active";
            $status_order = "proses";
            $valueKamar = "status='$status_kamar', id_pelanggan='$idPelanggan'";
            $valueOrder = "status='$status_order'";
            $response = $dtr->update("tb_order_kamar", $valueOrder, "id_reservasi", $data5['id_reservasi'], "");
            $response = $dtr->update("tb_kamar", $valueKamar, "id", $idK, "pageResepsionis.php?page=cekdta");
        }   
    }
    if(isset($_GET['cek_out'])){
        foreach($data4 as $value){
            $idK = $value['id'];
            $status_kamar = "non-active";
            $status = "selesai";
            $status_order = "selesai";
            $value = "status='$status'";
            $valueKamar = "status='$status_kamar', id_pelanggan=''";
            $valueOrder = "status='$status_order'";
            $response = $dtr->update("tb_kamar", $valueKamar, "id", $idK, "");
            $response = $dtr->update("tb_order_kamar", $valueOrder, "id_reservasi", $data5['id_reservasi'], "");
            $response = $dtr->update("tb_reservasi", $value, "id_reservasi", $_GET['kd'], "pageResepsionis.php?page=cekdta");
        }   
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Da Hotel</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Reservasi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Reservasi</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-12">
                                    <form action="" method="POST">
                                        <div class="row justify-content-between">
                                            <div class="col-3">
                                                <label>Sort By Date:</label> 
                                                <div class="input-group">
                                                    <input type="date" class="form-control" name="date_in" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary" name="btnFilter">
                                                            <i class="fas fa-search fa-fw"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <label>Sort By Name:</label> 
                                                <div class="input-group">
                                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="nama_tamu" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" name="btnSearch">
                                                            <i class="fas fa-search fa-fw"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px">ID</th>
                                        <th>Nama Tamu</th>
                                        <th>Type Kamar</th>
                                        <th>Cek In</th>
                                        <th>Cek Out</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($_POST['btnFilter'])){
                                            $Date_in = $_POST['date_in'];
                                            $data = $dtr->selectFind("tb_reservasi", "cek_in", $Date_in);
                                        }else if(isset($_POST['btnSearch'])){
                                            $tamu = $_POST['nama_tamu'];
                                            $data = $dtr->select_joinFind("tb_reservasi","tb_pelanggan", $tamu);
                                        }else{
                                            $data = $dtr->selectWhere2("tb_reservasi", "status", "proses");
                                        }
                                            foreach ($data as $datas) {
                                                $dta_cekin = date_create($datas['cek_in']);
                                                $dta_cekout = date_create($datas['cek_out']);
                                                $data2 = $dtr->selectWhere("tb_pelanggan","id_pelanggan",$datas['id_pelanggan']);
                                                $data3 = $dtr->selectWhere("tb_kategori","id_kategori",$datas['id_kategori']);
                                    ?>
                                        <tr>
                                            <td><?=$datas['id_reservasi']?></td>
                                            <td><?=$data2['nama_tamu']?></td>
                                            <td>
                                                <?=$data3['nama_kategori']?>
                                                (
                                                <?php
                                                    $data6 = $dtr->selectWhere2("tb_order_kamar", "id_reservasi", $datas['id_reservasi']);
                                                    foreach($data6 as $dta3){
                                                        $data7 = $dtr->selectWhere2("tb_kamar", "id", $dta3['id']);
                                                        foreach($data7 as $dta){
                                                ?>
                                                    <span class="badge bg-primary"><?=$dta['no_kamar']?></span>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                                )
                                            </td>
                                            <td><?=date_format($dta_cekin,"d/m/Y")?></td>
                                            <td><?=date_format($dta_cekout,"d/m/Y")?></td>
                                            <td class="project-actions text-right">
                                                <button type="button" class="btn bg-info btn-sm" data-toggle="modal" data-target="#modal-lg<?=$datas['id_reservasi']?>">
                                                    <span class="info-box-icon bg-info"><i class="fas fa-info"></i></span>
                                                    <span class="info-box-text">Details</span>
                                                </button>
                                                <?php
                                                    $data5 = $dtr->selectWhere2("tb_order_kamar","id_reservasi", $datas['id_reservasi']);
                                                    foreach($data5 as $dta){
                                                        $data6 = $dtr->selectWhere("tb_kamar", "id", $dta['id']);
                                                    }
                                                    if($data6['status'] == 'active' && $dta['status'] == 'proses'){
                                                ?>
                                                    <a id="btnCekOut<?=$datas['id_reservasi']?>" class="btn btn-sm bg-danger">
                                                        <span class="info-box-icon bg-danger"><i class="fas fa-check"></i></span>
                                                        <span class="info-box-text">CEK OUT</span>
                                                    </a>
                                                <?php
                                                    }else{
                                                ?>
                                                    <a id="btnCekIn<?=$datas['id_reservasi']?>" class="btn btn-sm bg-warning">
                                                        <span class="info-box-icon bg-warning"><i class="fas fa-check"></i></span>
                                                        <span class="info-box-text">CEK IN</span>
                                                    </a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <script src="plugins/jquery-3.2.1.min.js"></script>
                                        <script>
                                            $("#btnCekIn<?=$datas['id_reservasi']?>").click(function(e){
                                                e.preventDefault();
                                                swal({
                                                title: "Pilih",
                                                text: "Yakin Cek In?",
                                                type: "info",
                                                showCancelButton: true,
                                                confirmButtonText: "Yes",
                                                cancelButtonText: "Cancel",
                                                closeOnConfirm: false,
                                                closeOnCancel: true
                                                }, function(isConfirm) {
                                                    if (isConfirm) {
                                                        window.location.href="pageResepsionis.php?page=cekdta&cek_in&kd=<?=$datas['id_reservasi']?>";
                                                    }
                                                });
                                            });
                                        </script>
                                        <script>
                                            $("#btnCekOut<?=$datas['id_reservasi']?>").click(function(e){
                                                e.preventDefault();
                                                swal({
                                                title: "Pilih",
                                                text: "Yakin Cek Out?",
                                                type: "info",
                                                showCancelButton: true,
                                                confirmButtonText: "Yes",
                                                cancelButtonText: "Cancel",
                                                closeOnConfirm: false,
                                                closeOnCancel: true
                                                }, function(isConfirm) {
                                                    if (isConfirm) {
                                                        window.location.href="pageResepsionis.php?page=cekdta&cek_out&kd=<?=$datas['id_reservasi']?>";
                                                    }
                                                });
                                            });
                                        </script>
                                        <div class="modal fade" id="modal-lg<?=$datas['id_reservasi']?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <form action="" method="POST">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Details </h4>
                                                            <span class="badge bg-info mx-2"><?=$datas['status']?></span>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-10 mx-5">
                                                                <div class="form-group">
                                                                    <p>Tgl Reservasi :</p>
                                                                    <input type="text" class="form-control" value="<?=$datas['tgl_reservasi']?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <p>Nama Pemesan :</p>
                                                                    <input type="text" class="form-control" value="<?=$data2['nama_lengkap']?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <p>No Telepone :</p>
                                                                    <input type="text" class="form-control" value="<?=$data2['no_tlp']?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <p>Email :</p>
                                                                    <input type="text" class="form-control" value="<?=$data2['email']?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    <?php
                                        }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->


        <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <script>
        $(function () {
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });
        });
    </script>
</body>
</html>