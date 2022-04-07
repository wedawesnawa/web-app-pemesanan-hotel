<?php
    if(isset($_POST['btnFasilitas'])){
        $autokode = $dtk->autokode("tb_fasilitas_hotel", "id_fasilitas_hotel", "FH");

        $idFasilitas = $autokode;
        $fasilitas = $_POST['fasilitas'];
        $foto = $_FILES['foto'];

        if ($foto == "" || $fasilitas == "") {
            $response = ['response' => 'negative', 'alert' => 'Lengkapi Field'];
        } else {
            $response = $dtk->validateImage();
            if ($response['types'] == "true") {
                $value    = "'$idFasilitas', '$fasilitas', '$response[image]'";
                $response = $dtk->insert("tb_fasilitas_hotel", $value, "pageAdmin.php?page=dtahotel");
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
                        <h1>Tambah Fasilitas</h1>
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
                                        <p class="text-muted">Tambah Fasilitas</p>
                                        <input type="text" class="form-control" placeholder="Fasilitas" name="fasilitas" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <p class="text-muted">Icon Fasilitas</p>
                                        <input type="file" name="foto" id="photo" data-allowed-file-extensions="png jpg jpeg" class="dropify">  
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-primary" name="btnFasilitas">
                                            <i class="fas fa-plus"></i> Tambah
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