<?php
    if(isset($_POST['btnHotel'])){
        $autokode = $dtk->autokode("tb_hotel", "id_hotel", "DH");

        $idHotel = $autokode;
        $keterangan = $_POST['keterangan'];
        $foto = $_POST['foto1'];
        $foto1 = $_POST['foto2'];
        $foto2 = $_POST['foto3'];
        $foto3 = $_POST['foto4'];
        $foto4 = $_POST['foto5'];

        $value = "'$idHotel','$keterangan','$foto','$foto1','$foto2','$foto3','$foto4'";
        $response = $dtk->insert("tb_hotel",$value,"pageAdmin.php");
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
                    <h1>Data Hotel</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Simple Tables</li>
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
                    <div class="card">                                
                        <div class="card-body p-5">
                            <form action="" method="POST">
                                <h4>Tambah Data</h4>
                                <div class="row mt-5">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <p>Keterangan</p>
                                            <textarea class="form-control" rows="2" placeholder="Enter ..." name="keterangan"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <p>Foto 1</p>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="foto1">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <p>Foto 2</p>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="foto2">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <p>Foto 3</p>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="foto3">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <p>Foto 4</p>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="foto4">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <p>Foto 5</p>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="foto5">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary" name="btnHotel">
                                        Submit
                                    </button>
                                </div> 
                            </form>                
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
</body>
</html>