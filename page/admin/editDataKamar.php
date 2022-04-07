<?php
    $data = $dtk->selectWhere("tb_kategori", "id_kategori", $_GET['id']);

    if(isset($_POST['btnEdit'])){
        $name = $dtk->validateHtml($_POST['tipe_kamar']);
        $harga = $dtk->validateHtml($_POST['harga']);
        $foto = $_FILES['foto'];

        if($name == "" || $harga =="" || $foto == ""){
            $response = ['response'=>'negative','alert'=>'Lengkapi Field'];
        }else{
            if($_FILES['foto']['name'] == ""){
                $value = "nama_kategori='$name', harga='$harga'";
                $response = $dtk->update("tb_kategori", $value, "id_kategori", $_GET['id'], "pageAdmin.php?page=dtakamar");
            }else{
                $response = $dtk->validateImage();
                if($response['types'] == "true"){
                    $value = "nama_kategori='$name', harga='$harga', foto_kategori='$response[image]'";
                    $response = $dtk->update("tb_kategori", $value, "id_kategori", $_GET['id'], "pageAdmin.php?page=dtakamar");
                }else{
                    $response = ['response'=>'negative', 'alert'=>'Gambar Error'];
                }
            }
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
                        <h1>Edit Kamar</h1>
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
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript: history.go(-1)">
                                            <i class="fas fa-arrow-circle-left"></i> Kembali 
                                        </a>
                                    </div>
                                </div>                               
                            </div>
                            <!-- /.card-header --> 
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <p class="text-muted">Tipe Kamar</p>
                                        <input type="text" class="form-control" value="<?= $data['nama_kategori']?>" name="tipe_kamar" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted">Harga</p>
                                        <input type="text" class="form-control" value="<?= $data['harga']?>" name="harga" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted">Foto Kamar</p>
                                        <input type="file" name="foto" id="photo" data-allowed-file-extensions="png jpg jpeg" class="dropify" data-default-file="img/<?= $data['foto_kategori'] ?>">  
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-primary" name="btnEdit">
                                            <i class="fa fa-edit"></i>Edit
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                            
                        </div>
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
        bsCustomFileInput.init();
        $('.dropify').dropify();
        });
    </script>
</body>
</html>