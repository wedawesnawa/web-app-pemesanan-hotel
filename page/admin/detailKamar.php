<?php
    $getId = $_GET['id'];
    $data = $dtk->selectWhere2("tb_kamar","id_kategori","$getId");
    $data2 = $dtk->selectWhere2("tb_fasilitas_kamar","id_kategori","$getId");
    $data3 = $dtk->selectWhere2("tb_foto_kamar","id_kategori","$getId");
    $data4 = $dtk->selectWhere("tb_fasilitas_kamar","id_fasilitas_kamar",@$_GET['idFasilitas']);
    $sql = "SELECT no_kamar FROM tb_kamar ORDER BY id DESC LIMIT 1;";
    $exe = mysqli_query($con, $sql);
    $num = mysqli_num_rows($exe);
    $dta = mysqli_fetch_assoc($exe);

    if(isset($_POST['btnKamar'])){
        $jumlah = $_POST['jumlah'];
        $status = "non-active";
        $idKategori = $_GET['id'];

        if (!empty($_POST['jumlah'])){
            if ($num > 0) {
                for ($i = 1; $i <= $jumlah; $i++) {
                    $total    = $dta['no_kamar'] + $i;
                    $name     = $total;
                    $value    = "'','$name', '$idKategori','','$status'";
                    $response = $dtk->insert("tb_kamar", $value, "pageAdmin.php?page=detailkamar&details&id=$getId");
                }
            } else {
                for ($i = 1; $i <= $jumlah; $i++) {
                  $name     = $i;
                  $value    = "'','$name', '$idKategori', '', '$status'";
                  $response = $dtk->insert("tb_kamar", $value, "pageAdmin.php?page=detailkamar&details&id=$getId");
                }
            }
        }
    }
    if(isset($_POST['btnFasilitas'])){
        $autokode = $dtk->autokode("tb_fasilitas_kamar", "id_fasilitas_kamar", "LF");

        $idFasilitas = $autokode;
        $fasilitas = $_POST['fasilitas'];
        $idKategori = $_GET['id'];

        $value = "'$idFasilitas','$idKategori','$fasilitas'";
        $response = $dtk->insert("tb_fasilitas_kamar",$value,"pageAdmin.php?page=detailkamar&details&id=$getId");
    }
    if(isset($_POST['btnFoto'])){
        $autokode = $dtk->autokode("tb_foto_kamar", "id_foto_kamar ", "LP");

        $idFoto = $autokode;
        $foto = $_FILES['foto'];
        $idKategori = $_GET['id'];

        if ($foto == "") {
            $response = ['response' => 'negative', 'alert' => 'Lengkapi Field'];
        } else {
            $response = $dtk->validateImage();
            if ($response['types'] == "true") {
                $value = "'$idFoto','$response[image]','$idKategori'";
                $response = $dtk->insert("tb_foto_kamar",$value,"pageAdmin.php?page=detailkamar&details&id=$getId");
            }
        } 
    }
    if (isset($_POST['btnUpdate'])) {

        $name = $_POST['updateFasilitas'];
        if ($name == "") {
            $response = ['response' => 'negative', 'alert' => 'Tidak ada fasilitas'];
        } else {
            $value    = "nama_fasilitas='$name'";
            $response = $dtk->update("tb_fasilitas_kamar", $value, "id_fasilitas_kamar", $_GET['idFasilitas'], "pageAdmin.php?page=detailkamar&details&id=$getId");
        }
    }
    if(isset($_POST['updateFoto'])) {
        $id = $_POST['id_foto'];
        $foto = $_POST['foto_kamar'];
        if($foto == ""){
            $response = ['response' => 'negative', 'alert'=> 'Tidak ada foto'];
        } else{
            $value = "foto='$foto'";
            $response = $dtk->update("tb_foto_kamar", $value, "id_foto_kamar", $id, "pageAdmin.php?page=detailkamar&details&id=$getId");
        }
    }
    if (isset($_GET['delete'])) {
        $response = $dtk->delete("tb_kamar", "id", $_GET['idKamar'], "pageAdmin.php?page=detailkamar&details&id=$getId");
    }
    if (isset($_GET['dltFasilitas'])) {
        $response = $dtk->delete("tb_fasilitas_kamar", "id_fasilitas_kamar", $_GET['idFasilitas'], "pageAdmin.php?page=detailkamar&details&id=$getId");
    }
    if (isset($_GET['dltFoto'])) {
        $response = $dtk->delete("tb_foto_kamar", "id_foto_kamar", $_GET['idFoto'], "pageAdmin.php?page=detailkamar&details&id=$getId");
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
                    <h1>Details Kamar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Detail Kamar</li>
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
                                    <a class="nav-link active"data-toggle="tab" href="#custom-tabs-two-home" role="tab">Nomor Kamar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#custom-tabs-two-profile" role="tab">Fasilitas Kamar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#custom-tabs-two-messages" role="tab">Foto Kamar</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="custom-tabs-two-home">
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Tambah Kamar</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <p class="text-muted">Jumlah Kamar</p>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" placeholder="Jumlah Kamar..." name="jumlah">
                                                                <span class="input-group-append">
                                                                    <button type="submit" class="btn btn-info btn-flat" name="btnKamar">Masukan</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Nomor Kamar</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <ul class="nav nav-pills ml-auto">
                                                        <?php
                                                            $no = 1;
                                                            foreach ($data as $ds) {
                                                        ?>
                                                            <li class="nav-item m-1">
                                                                <a class="nav-link btn btn-default btn-sm" title="Delete" href="" id="btnDelete<?=$no;?>">
                                                                    <span class="text-lg"><?=$ds['no_kamar']?></span>
                                                                </a>
                                                            </li>
                                                        <script src="plugins/jquery-3.2.1.min.js"></script>
                                                        <script>
                                                            $("#btnDelete<?=$no?>").click(function(e){
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
                                                                    window.location.href="pageAdmin.php?page=detailkamar&details&id=<?=$getId;?>&delete&idKamar=<?php echo $ds['id'] ?>";
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                        <?php
                                                            $no++;}
                                                        ?>
                                                        </ul>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-two-profile">
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Tambah Fasilitas Kamar</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <p class="text-muted">Tambah Fasilitas</p>
                                                            <input type="text" class="form-control" placeholder="Fasilitas" name="fasilitas" autocomplete="off">
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-sm btn-primary" name="btnFasilitas">
                                                                <i class="fas fa-plus"></i> Tambah
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Update Fasilitas Kamar</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <p class="text-muted">Update Fasilitas</p>
                                                            <input type="text" class="form-control" placeholder="Fasilitas" name="updateFasilitas" value="<?php echo @$data4['nama_fasilitas'] ?>" autocomplete="off">
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-sm btn-primary" name="btnUpdate">
                                                                <i class="fas fa-check"></i> Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Fasilitas Kamar</h3>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>List Fasilitas</th>
                                                                    <th style="width: 40%"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                if (count($data2) > 0) {
                                                                $no = 1;
                                                                foreach ($data2 as $datas) {
                                                            ?>
                                                                <tr>
                                                                    <td><?=$no++;?></td>
                                                                    <td><?=$datas['nama_fasilitas'];?></td>
                                                                    <td class="project-actions text-right">
                                                                        <a class="btn btn-info btn-sm" href="pageAdmin.php?page=detailkamar&details&id=<?=$getId;?>&edit&idFasilitas=<?=$datas['id_fasilitas_kamar']?>">
                                                                            <i class="fas fa-pencil-alt">
                                                                            </i>
                                                                            Edit
                                                                        </a>
                                                                        <a class="btn btn-danger btn-sm" id="deleteFasilitas<?=$datas['id_fasilitas_kamar']?>">
                                                                            <i class="fas fa-trash">
                                                                            </i>
                                                                            Delete
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <script>
                                                                    $("#deleteFasilitas<?=$datas['id_fasilitas_kamar']?>").click(function(e){
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
                                                                            window.location.href="pageAdmin.php?page=detailkamar&details&id=<?=$getId;?>&dltFasilitas&idFasilitas=<?php echo $datas['id_fasilitas_kamar'] ?>";
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
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-two-messages">
         
                                        <div class="row">
                                            <div class="col-md-4">
                                                <form method="POST" enctype="multipart/form-data">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Tambah Foto Kamar</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            
                                                            <div class="form-group">
                                                                <p class="text-muted">Foto Kamar</p>
                                                                <input type="file" name="foto" id="photo" data-allowed-file-extensions="png jpg jpeg" class="dropify">  
                                                            </div>
                                                            <div class="text-right">
                                                                <button class="btn btn-sm btn-primary" name="btnFoto">
                                                                    <i class="fas fa-plus"></i> Tambah
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
                                                        <h3 class="card-title">Foto Kamar</h3>
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
                                                                        <a class="btn btn-info btn-sm" href="pageAdmin.php?page=editfotokamar&editfoto&id=<?=$getId;?>&editFoto&idFoto=<?php echo $datas3['id_foto_kamar'] ?>">
                                                                            <i class="fas fa-pencil-alt"></i>
                                                                            Edit
                                                                        </a>
                                                                        <a class="btn btn-danger btn-sm" id="dltFoto<?=$datas3['id_foto_kamar']?>">
                                                                            <i class="fas fa-trash">
                                                                            </i>
                                                                            Delete
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <script>
                                                                    $("#dltFoto<?=$datas3['id_foto_kamar']?>").click(function(e){
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
                                                                            window.location.href="pageAdmin.php?page=detailkamar&details&id=<?=$getId;?>&dltFoto&idFoto=<?php echo $datas3['id_foto_kamar'] ?>";
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
</body>
</html>