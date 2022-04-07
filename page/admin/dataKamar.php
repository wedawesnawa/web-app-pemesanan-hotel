<?php
    $autokode = $dtk->autokode("tb_kategori", "id_kategori", "KT");
    $data = $dtk->select("tb_kategori");
    if(isset($_POST['btnAdd'])){
        $id_kategori = $autokode;
        $nama = $_POST['nama_kls'];
        $harga = $_POST['harga_kls'];
        $redirect = "pageAdmin.php?page=dtakamar";
        $foto = $_FILES['foto'];

        if ($nama == "" || $foto == "" || $harga == "") {
            $response = ['response' => 'negative', 'alert' => 'Lengkapi Field'];
        } else {
            $response = $dtk->validateImage();
            if ($response['types'] == "true") {
                $value = "'$id_kategori','$nama','$response[image]','$harga'";
                $response = $dtk->insert("tb_kategori",$value, $redirect);
            }
        } 
    }
    if(isset($_POST['btnEdit'])){
        $tharga = $_POST['harga_tipe'];
        $idKT = $_POST['idKT'];

        if($tharga == ""){
            $response = ['response' => 'negative', 'alert' => 'Lengkapi Field !!!'];
        }else{
            $value    = "harga='$tharga'";
            $response = $dtk->update("tb_kategori", $value, "id_kategori", $idKT, "pageAdmin.php?page=dtakamar");
        }
    }
    if(isset($_GET['delete'])){
        $id = $_GET['id'];
        $response = $dtk->delete("tb_kategori", "id_kategori", $id, "pageAdmin.php?page=dtakamar");
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
                    <h1>Data Kamar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Kamar</li>
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
                                <div class="text-right mb-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                                        <i class="fa fa-plus"></i> 
                                        Tambah Kamar
                                    </button>
                                </div>
                                
                                <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">NO</th>
                                        <th style="width: 20%">Tipe Kamar</th>
                                        <th style="width: 30%">Foto Kamar</th>
                                        <th>Harga</th>
                                        <th style="width: 20%">Action</th>
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
                                        <td><?=$datas['nama_kategori'];?></td>
                                        <td>
                                            <img src="img/<?=$datas['foto_kategori'];?>" alt="photo" class="img-fluid" style="width:100%; height: 150px !important;">    
                                        </td>
                                        <td>RP. <?=$datas['harga'];?></td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="pageAdmin.php?page=detailkamar&details&id=<?=$datas['id_kategori'];?>">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="pageAdmin.php?page=editkamar&edit&id=<?=$datas['id_kategori'];?>">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" id="ktDelete<?=$datas['id_kategori']?>">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <script>
                                        $("#ktDelete<?=$datas['id_kategori']?>").click(function(e){
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
                                                window.location.href="pageAdmin.php?page=dtakamar&delete&id=<?=$datas['id_kategori']?>";
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
        </section>
        <!-- /.content -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Kamar</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-10 mx-5">
                                <div class="form-group">
                                    <p>Nama Tipe Kamar</p>
                                    <input type="text" class="form-control" name="nama_kls" placeholder="Masukan nama tipe...">
                                </div>
                                <div class="form-group">
                                    <p>Harga</p>
                                    <input type="number" class="form-control" name="harga_kls" placeholder="Masukan harga ...">
                                </div>
                                <div class="form-group">
                                    <p class="text-muted">Foto Kamar</p>
                                    <input type="file" name="foto" id="photo" data-allowed-file-extensions="png jpg jpeg" class="dropify">  
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="btnAdd">Tambah</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <script>
        $(function () {
        bsCustomFileInput.init();
        $('.dropify').dropify();
        });
    </script>
</body>
</html>