<?php
    $getId = $_GET['id'];
    $data = $dtk->selectWhere("tb_foto_kamar", "id_foto_kamar", $_GET['idFoto']);

    if(isset($_POST['btnEdit'])){
        $foto = $_FILES['foto'];

        if($foto == ""){
            $response = ['response'=>'negative','alert'=>'Lengkapi Field'];
        }else{
            $response = $dtk->validateImage();
            if($response['types'] == "true"){
                $value = "foto='$response[image]'";
                $response = $dtk->update("tb_foto_kamar", $value, "id_foto_kamar", $_GET['idFoto'], "pageAdmin.php?page=detailkamar&details&id=$getId");
            }else{
                $response = ['response'=>'negative', 'alert'=>'Gambar Error'];
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
                        <h1>Edit Foto Kamar</h1>
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
                                        <p class="text-muted">Foto Hotel</p>
                                        <input type="file" name="foto" id="photo" data-allowed-file-extensions="png jpg jpeg" class="dropify" data-default-file="img/<?= $data['foto'] ?>">  
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-primary" name="btnEdit">
                                            <i class="fa fa-edit"></i> Edit
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