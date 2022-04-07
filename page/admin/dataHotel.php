<?php
    $data = $dtk->select("tb_fasilitas_hotel");
    $data1 = $dtk->selectWhere("tb_fasilitas_hotel","id_fasilitas_hotel",@$_GET['idFasilitas']);
    $data2 = $dtk->select("tb_hotel");
    $data5 = $dtk->selectWhere("tb_hotel", "id_hotel", @$_GET['idKeterangan']);
    $data3 = $dtk->select("tb_foto_hotel");
    $data7 = $dtk->selectWhere("tb_foto_hotel", "id_foto_hotel", @$_GET['idFoto']);
    $data4 = $dtk->select("tb_lokasi");
    $data6 = $dtk->selectWhere("tb_lokasi", "id_lokasi", @$_GET['idLandmark']);

    if(isset($_POST['btnKeterangan'])){
        $autokode = $dtk->autokode("tb_hotel", "id_hotel", "HT");

        $idKeterangan = $autokode;
        $keterangan = $_POST['txt'];

        if ($keterangan == "") {
            $response = ['response' => 'negative', 'alert' => 'Lengkapi Field'];
        } else {
            $value    = "'$idKeterangan', '$keterangan'";
            $response = $dtk->insert("tb_hotel", $value, "pageAdmin.php?page=dtahotel");
        } 
    }
    if(isset($_POST['btnLandmark'])){
        $autokode = $dtk->autokode("tb_lokasi", "id_lokasi", "HL");

        $idLokasi = $autokode;
        $landmark = $_POST['landmark'];
        $jarak = $_POST['jarak'];

        if ($landmark == "" || $jarak == "") {
            $response = ['response' => 'negative', 'alert' => 'Lengkapi Field'];
        } else {
            $value    = "'$idLokasi', '$landmark', '$jarak'";
            $response = $dtk->insert("tb_lokasi", $value, "pageAdmin.php?page=dtahotel");
        } 
    }
    if (isset($_POST['btnUpdate'])) {
        $name = $dtk->validateHtml($_POST['updateFasilitas']);
        $foto = $_FILES['foto'];

        if($name == "" || $foto == ""){
            $response = ['response'=>'negative','alert'=>'Lengkapi Field'];
        }else{
            if($_FILES['foto']['name'] == ""){
                $value = "nama_fasilitas='$name'";
                $response = $dtk->update("tb_fasilitas_hotel", $value, "id_fasilitas_hotel", $_GET['idFasilitas'], "pageAdmin.php?page=dtahotel");
            }else{
                $response = $dtk->validateImage();
                if($response['types'] == "true"){
                    $value = "nama_fasilitas='$name', foto='$response[image]'";
                    $response = $dtk->update("tb_fasilitas_hotel", $value, "id_fasilitas_hotel", $_GET['idFasilitas'], "pageAdmin.php?page=dtahotel");
                }else{
                    $response = ['response'=>'negative', 'alert'=>'Gambar Error'];
                }
            }
        }
    }
    if(isset($_POST['btnUpFoto'])){
        $foto = $_FILES['foto'];

        if($foto == ""){
            $response = ['response'=>'negative','alert'=>'Lengkapi Field'];
        }else{
            $response = $dtk->validateImage();
            if($response['types'] == "true"){
                $value = "foto='$response[image]'";
                $response = $dtk->update("tb_foto_hotel", $value, "id_foto_hotel", $_GET['idFoto'], "pageAdmin.php?page=dtahotel");
            }else{
                $response = ['response'=>'negative', 'alert'=>'Gambar Error'];
            }
        }
    }
    if(isset($_POST['btnUpTxt'])){
        $keterangan = $_POST['txtKeterangan'];

        if ($keterangan == "") {
            $response = ['response' => 'negative', 'alert' => 'Lengkapi Field'];
        } else {
            $value    = "keterangan='$keterangan'";
            $response = $dtk->update("tb_hotel", $value, 'id_hotel', $_GET['idKeterangan'], "pageAdmin.php?page=dtahotel");
        } 
    }
    if(isset($_POST['btnUpMark'])){
        $landmark = $_POST['landmark'];
        $jarak = $_POST['jarak'];

        if ($landmark == "" || $jarak == "") {
            $response = ['response' => 'negative', 'alert' => 'Lengkapi Field'];
        } else {
            $value    = "list='$landmark', jarak='$jarak'";
            $response = $dtk->update("tb_lokasi", $value, 'id_lokasi', $_GET['idLandmark'],"pageAdmin.php?page=dtahotel");
        } 
    }
    if (isset($_GET['dltFasilitas'])) {
        $response = $dtk->delete("tb_fasilitas_hotel", "id_fasilitas_hotel", $_GET['idFasilitas'], "pageAdmin.php?page=dtahotel");
    }
    if (isset($_GET['dltFoto'])) {
        $response = $dtk->delete("tb_foto_hotel", "id_foto_hotel", $_GET['idFoto'], "pageAdmin.php?page=dtahotel");
    }
    if (isset($_GET['dltTxt'])) {
        $response = $dtk->delete("tb_hotel", "id_hotel", $_GET['idKeterangan'], "pageAdmin.php?page=dtahotel");
    }
    if (isset($_GET['dltLandmark'])) {
        $response = $dtk->delete("tb_lokasi", "id_lokasi", $_GET['idLandmark'], "pageAdmin.php?page=dtahotel");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Da Hotel</title>
    <style>
        .attachment-block{
            background-color: transparent;
            border: none;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Hotel</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Hotel</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#custom-tabs-two-profile" role="tab" >Fasilitas Hotel</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#custom-tabs-two-messages" role="tab" >Foto Hotel</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#custom-tabs-two-deskripsi" role="tab" >Keterangan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#custom-tabs-two-lokasi" role="tab" >Lokasi Terdekat</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="custom-tabs-two-profile">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Update Fasilitas Hotel</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <p class="text-muted">Update Fasilitas</p>
                                                        <input type="text" class="form-control" placeholder="Fasilitas" name="updateFasilitas" value="<?php echo @$data1['nama_fasilitas'] ?>" autocomplete="off">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted">Icon Fasilitas</p>
                                                        <input type="file" name="foto" id="photo" data-allowed-file-extensions="png jpg jpeg" class="dropify" data-default-file="img/<?= @$data1['foto']?>">
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-sm btn-primary" name="btnUpdate">
                                                            <i class="fas fa-check"></i> Update
                                                        </button>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Fasilitas Hotel</h3>
                                                    <a href="pageAdmin.php?page=addfasilitas" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus mr-2"></i>Tambah</a>
                                                </div>
                                                <div class="card-body p-0">
                                                    <table class="table table-striped projects">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>List Fasilitas</th>
                                                                <th style="width: 10%"></th>
                                                                <th style="width: 40%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            if (count($data) > 0) {
                                                            $no = 1;
                                                            foreach ($data as $datas) {
                                                        ?>
                                                            <tr>
                                                                <td><?=$no++;?></td>
                                                                <td><?=$datas['nama_fasilitas'];?></td>
                                                                <td>
                                                                    <ul class="list-inline">
                                                                        <li class="list-inline-item">
                                                                            <img alt="Avatar" class="table-avatar" src="img/<?=$datas['foto']?>">
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                                <td class="project-actions text-right">
                                                                    <a class="btn btn-info btn-sm" href="pageAdmin.php?page=dtahotel&edit&idFasilitas=<?=$datas['id_fasilitas_hotel']?>">
                                                                        <i class="fas fa-pencil-alt">
                                                                        </i>
                                                                        Edit
                                                                    </a>
                                                                    <a class="btn btn-danger btn-sm" id="deleteFasilitas<?=$datas['id_fasilitas_hotel']?>">
                                                                        <i class="fas fa-trash">
                                                                        </i>
                                                                        Delete
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <script src="plugins/jquery-3.2.1.min.js"></script>
                                                            <script>
                                                                $("#deleteFasilitas<?=$datas['id_fasilitas_hotel']?>").click(function(e){
                                                                    e.preventDefault();
                                                                    swal({
                                                                    title: "Hapus",
                                                                    text: "Yakin menghapus data?",
                                                                    type: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonText: "Yes",
                                                                    cancelButtonText: "Cancel",
                                                                    closeOnConfirm: false,
                                                                    closeOnCancel: true
                                                                    }, function(isConfirm) {
                                                                        if (isConfirm) {
                                                                        window.location.href="pageAdmin.php?page=dtahotel&dltFasilitas&idFasilitas=<?php echo $datas['id_fasilitas_hotel'] ?>";
                                                                        }
                                                                    });
                                                                });
                                                            </script>
                                                        <?php
                                                            }
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
                                <div class="tab-pane fade" id="custom-tabs-two-messages">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Update Foto Hotel</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <p class="text-muted">Foto Hotel</p>
                                                        <input type="file" name="foto" id="photo" data-allowed-file-extensions="png jpg jpeg" class="dropify" data-default-file="img/<?= @$data7['foto'] ?>">  
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-sm btn-primary" name="btnUpFoto">
                                                            <i class="fas fa-check"></i> Update
                                                        </button>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Foto Kamar</h3>
                                                    <a href="pageAdmin.php?page=addfhotel" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus mr-2"></i>Tambah</a>
                                                </div>
                                                <div class="card-body p-0">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Foto</th>
                                                                <th style="width: 40%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                if (count($data3) > 0) {
                                                                $no = 1;
                                                                foreach ($data3 as $datas3) {
                                                            ?>
                                                            <tr>
                                                                <td><?=$no++;?></td>
                                                                <td>
                                                                    <div class="col-sm-6">
                                                                        <img src="img/<?=$datas3['foto'];?>" alt="photo" class="img-fluid">
                                                                    </div>    
                                                                </td>
                                                                <td class="project-actions text-right">
                                                                    <a class="btn btn-info btn-sm" href="pageAdmin.php?page=dtahotel&edit&idFoto=<?=$datas3['id_foto_hotel']?>">
                                                                        <i class="fas fa-pencil-alt">
                                                                        </i>
                                                                        Edit
                                                                    </a>
                                                                    <a class="btn btn-danger btn-sm" id="dltFoto<?=$datas3['id_foto_hotel']?>">
                                                                        <i class="fas fa-trash">
                                                                        </i>
                                                                        Delete
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <script>
                                                                $("#dltFoto<?=$datas3['id_foto_hotel']?>").click(function(e){
                                                                    e.preventDefault();
                                                                    swal({
                                                                    title: "Hapus",
                                                                    text: "Yakin menghapus data?",
                                                                    type: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonText: "Yes",
                                                                    cancelButtonText: "Cancel",
                                                                    closeOnConfirm: false,
                                                                    closeOnCancel: true
                                                                    }, function(isConfirm) {
                                                                        if (isConfirm) {
                                                                        window.location.href="pageAdmin.php?page=dtahotel&dltFoto&idFoto=<?php echo $datas3['id_foto_hotel'] ?>";
                                                                        }
                                                                    });
                                                                });
                                                            </script>
                                                            <?php
                                                                }
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
                                <div class="tab-pane fade" id="custom-tabs-two-deskripsi">
                                    <div class="row">
                                        <div class="col-md-4">
                                        <form action="" method="POST">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Tambah Keterangan Hotel</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <p class="text-muted">Keterangan</p>
                                                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="txt"></textarea>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-sm btn-primary" name="btnKeterangan">
                                                            <i class="fas fa-plus"></i> Tambah
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Update Keterangan</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <p class="text-muted">Update Keterangan</p>
                                                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="txtKeterangan"><?php echo @$data5['keterangan'] ?></textarea>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-sm btn-primary" name="btnUpTxt">
                                                            <i class="fas fa-check"></i> Update
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </form>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Keterangan</h3>
                                                </div>
                                                <div class="card-body p-0">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Keterangan </th>
                                                                <th style="width: 40%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                if (count($data2) > 0) {
                                                                $no = 1;
                                                                foreach ($data2 as $datas2) {
                                                            ?>
                                                            <tr>
                                                                <td><?=$no++;?></td>
                                                                <td>
                                                                    <?=$datas2['keterangan']?>
                                                                </td>
                                                                <td class="project-actions text-right">
                                                                    <a class="btn btn-info btn-sm" href="pageAdmin.php?page=dtahotel&edit&idKeterangan=<?=$datas2['id_hotel']?>">
                                                                        <i class="fas fa-pencil-alt">
                                                                        </i>
                                                                        Edit
                                                                    </a>
                                                                    <a class="btn btn-danger btn-sm" id="dltFoto<?=$datas2['id_hotel'];?>">
                                                                        <i class="fas fa-trash">
                                                                        </i>
                                                                        Delete
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <script>
                                                                $("#dltFoto<?=$datas2['id_hotel'];?>").click(function(e){
                                                                    e.preventDefault();
                                                                    swal({
                                                                    title: "Hapus",
                                                                    text: "Yakin menghapus data?",
                                                                    type: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonText: "Yes",
                                                                    cancelButtonText: "Cancel",
                                                                    closeOnConfirm: false,
                                                                    closeOnCancel: true
                                                                    }, function(isConfirm) {
                                                                        if (isConfirm) {
                                                                        window.location.href="pageAdmin.php?page=dtahotel&dltTxt&idKeterangan=<?php echo $datas2['id_hotel'] ?>";
                                                                        }
                                                                    });
                                                                });
                                                            </script>
                                                            
                                                            <?php
                                                                }
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
                                <div class="tab-pane fade" id="custom-tabs-two-lokasi">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Tambah Landmark</h3>
                                                </div>
                                                <div class="card-body">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <p class="text-muted">Tambah Landmark</p>
                                                        <input type="text" class="form-control" placeholder="landmark" name="landmark" autocomplete="off">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted">Jarak</p>
                                                        <input type="text" class="form-control" placeholder="jarak" name="jarak" autocomplete="off">
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-sm btn-primary" name="btnLandmark">
                                                            <i class="fas fa-plus"></i> Tambah
                                                        </button>
                                                    </div>
                                                </form>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Update Landmark</h3>
                                                </div>
                                                <div class="card-body">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <p class="text-muted">Update Landmark</p>
                                                        <input type="text" class="form-control" placeholder="landmark..." name="landmark" value="<?php echo @$data6['list'] ?>" autocomplete="off">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted">Jarak</p>
                                                        <input type="text" class="form-control" placeholder="jarak" name="jarak" value="<?php echo @$data6['jarak'] ?>" autocomplete="off">
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-sm btn-primary" name="btnUpMark">
                                                            <i class="fas fa-check"></i> Update
                                                        </button>
                                                    </div>
                                                </form>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Landmark</h3>
                                                </div>
                                                <div class="card-body p-0">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>List Landmark</th>
                                                                <th></th>
                                                                <th style="width: 40%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            if (count($data4) > 0) {
                                                            $no = 1;
                                                            foreach ($data4 as $datas) {
                                                        ?>
                                                            <tr>
                                                                <td><?=$no++;?></td>
                                                                <td><?=$datas['list'];?></td>
                                                                <td><?=$datas['jarak'];?></td>
                                                                <td class="project-actions text-right">
                                                                    <a class="btn btn-info btn-sm" href="pageAdmin.php?page=dtahotel&edit&idLandmark=<?=$datas['id_lokasi']?>">
                                                                        <i class="fas fa-pencil-alt">
                                                                        </i>
                                                                        Edit
                                                                    </a>
                                                                    <a class="btn btn-danger btn-sm" id="deleteLandmark<?=$datas['id_lokasi']?>">
                                                                        <i class="fas fa-trash">
                                                                        </i>
                                                                        Delete
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <script>
                                                                $("#deleteLandmark<?=$datas['id_lokasi']?>").click(function(e){
                                                                    e.preventDefault();
                                                                    swal({
                                                                    title: "Hapus",
                                                                    text: "Yakin menghapus data?",
                                                                    type: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonText: "Yes",
                                                                    cancelButtonText: "Cancel",
                                                                    closeOnConfirm: false,
                                                                    closeOnCancel: true
                                                                    }, function(isConfirm) {
                                                                        if (isConfirm) {
                                                                        window.location.href="pageAdmin.php?page=dtahotel&dltLandmark&idLandmark=<?php echo $datas['id_lokasi'] ?>";
                                                                        }
                                                                    });
                                                                });
                                                            </script>
                                                        <?php
                                                            }
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
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(function () {
        bsCustomFileInput.init();
        $('.dropify').dropify();
        });
    </script>
    <script>
        $(document).ready(function(){
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if(activeTab){
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>
</body>
</html>