<?php
    $autokode = $dtp->autokode("tb_pelanggan", "id_pelanggan", "PL");
    $autokode2 = $dtp->autokode("tb_reservasi", "id_reservasi", "RS");

    if(isset($_POST['btnConfirm'])){
        $id_pelanggan = $autokode;
        $id_reservasi = $autokode2;
        $nick = $_POST['nick_name'];
        $name = $_POST['nama_pemesan'];
        $tlp = $_POST['no_tlp'];
        $email = $_POST['email'];
        $tamu = $_POST['nama_tamu'];
        $no_kamar = $_POST['noKamar'];
        $date = date("Y-m-d");
        $cekIn = $_POST['cekIn'];
        $cekOut = $_POST['cekOut'];
        $Cin = date("Y-m-d",strtotime($cekIn));
        $Cout = date("Y-m-d",strtotime($cekOut));
        $status = "proses";
        $KT = $_POST['idKategori'];

        if ($nick == "" || $name == "" || $tlp == "" || $email == "" || $tamu == "") {
            $response = ['response' => 'negative', 'alert' => 'Lengkapi Field !!!'];
        }else{
            if (strlen($tlp) != 12) {
                $response = ['response' => 'negative', 'alert' => 'Number telepone tidak boleh 0 atau < 12'];
            }else{
                $value = "'$id_pelanggan', '$name', '$nick', '$tamu', '$tlp', '$email'";
                $response   = $dtp->insert("tb_pelanggan", $value, "index.php?page=orderdetail&detail&id=$id_pelanggan");            
                if($response){
                    $valueOrder = "'$id_reservasi','$id_pelanggan', '$Cin', '$Cout', '$KT', '$date', '$status'";
                    $response2 = $dtp->insert("tb_reservasi", $valueOrder, "index.php?page=orderdetail&detail&id=$id_pelanggan");
                    if ($no_kamar == "") {
                        $response = ['response' => 'negative', 'alert' => 'Lengkapi Field !!!'];
                    }else{
                        foreach($no_kamar as $noKamar){
                            $valueKamar = "'','$id_reservasi','$noKamar','$id_pelanggan','pesan'";
                            $response3 = $dtp->insert("tb_order_kamar", $valueKamar, "index.php?page=orderdetail&detail&id=$id_pelanggan");
                        }
                    }
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
    <title>Da Hotel | Order</title>
    <!-- BS Stepper -->
    <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">

         <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-gray">
            <div class="container">
                <a href="index3.html" class="navbar-brand">
                    <span class="brand-text font-weight-light">PEMESANAN </span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                  
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper bg-white">

            <!-- Main content -->
            <div class="content">
            
                <div class="container">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="row mt-3">
                            <div class="col-md-8">
                                <div class="card">                                
                                    <div class="card-body">
                                        <h4>Detail Pemesan</h4>
                                        <div class="row mt-4">
                                            <div class="col-md-3 mr-0 pr-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="nick_name" autocomplete="off" id="txtFirst">
                                                </div>
                                                <!-- /input-group -->
                                                <p class="text-muted">Nama Sapaan</p>
                                            </div>
                                            <!-- /.col-lg-6 -->
                                            <div class="col-md-9 pr-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="nama_pemesan" autocomplete="off" id="txtFirst1">
                                                </div>
                                                <!-- /input-group -->
                                                <p class="text-muted">Nama Pemesan</p>
                                            </div>
                                            <div class="col-md-3 mr-0 pr-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="+62" autocomplete="off">
                                                </div>
                                                <!-- /input-group -->
                                                <p class="text-muted">Kode Negara</p>
                                            </div>
                                            <!-- /.col-lg-6 -->
                                            <div class="col-md-9 pr-3">
                                                <div class="input-group">
                                                    <input type="tel" pattern="^\d{12}$" class="form-control" name="no_tlp" autocomplete="off" maxlength="12">
                                                </div>
                                                <!-- /input-group -->
                                                <p class="text-muted">Nomor Telepon</p>
                                            </div>
                                            <div class="col pr-3">
                                                <div class="input-group">
                                                    <input type="email" class="form-control" name="email" autocomplete="off">
                                                </div>
                                                <!-- /input-group -->
                                                <p class="text-muted">Email</p>
                                            </div>                                  
                                        </div>
                                        <!-- /.row -->                             
                                    </div>
                                </div>
                                <div class="card">                                
                                    <div class="card-body">
                                        <h4>Detail Tamu</h4>
                                        <div class="row">
                                            <div class="col-md-12 pr-3">
                                                <div class="form-group row float-right">
                                                    <span class="text-muted mr-2">Sama seperti pemesan</span>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                        <label class="custom-control-label" for="customSwitch1"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mr-0 pr-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" autocomplete="off" id="txtSecond">
                                                </div>
                                                <!-- /input-group -->
                                                <p class="text-muted">Nama Sapaan</p>
                                            </div>
                                            <!-- /.col-lg-6 -->
                                            <div class="col-md-9 pr-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="nama_tamu" autocomplete="off" id="txtSecond1">
                                                </div>
                                                <!-- /input-group -->
                                                <p class="text-muted">Nama Pemesan</p>
                                            </div>                        
                                        </div>
                                        <!-- /.row -->                             
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php
                                    $total = 0;
                                    if (isset($_SESSION['reservasi'])){
                                        foreach($_SESSION['reservasi'] as $key => $value){ 
                                            
                                            $data = $dtp->selectWhere("tb_kategori","id_kategori",$value['id_kategori']);
                                            $data2 = $dtp->selectWhere2("tb_kamar","id_kategori",$value['id_kategori']);
                                            $total = $total + (int)$data['harga'] * (int)$value['qty'];
                                ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <h4>Detail Pemesanan</h4>
                                            <div class="info-box pt-0 mb-4">
                                                <div class="row">
                                                    <div class="info-box-icon mx-3 my-3">
                                                        <img class="img-fluid" src="img/<?=$data['foto_kategori'];?>" style="width:100%; height: 80px !important;">
                                                    </div>
                                                    <div class="info-box-content mt-3">
                                                        <h2 class="lead"><b>Da Hotel</b></h2>
                                                        <p class="text-muted text-sm"><?=$value['qty'];?>x kamar dengan tipe <b><?=$data['nama_kategori'];?></b></p>
                                                    </div>
                                                </div>  
                                            </div>
                                            <a>Cek-in</a><a class="float-right"><?=$value['cek_in'];?></a>
                                            <br>
                                            <a>Cek-out</a><a class="float-right"><?=$value['cek_out'];?></a>
                                            <hr>
                                            <a>Total</a><a class="float-right"><h2 class="lead"><b>RP. <?=number_format($total, 0, ',', '.');?></b></h2></a>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <h4>Pilih No Kamar</h4>
                                                <div class="callout callout-info">
                                                    <h5><i class="fas fa-info"></i> Note:</h5>
                                                    Pilihlah <?=$value['qty']?> no kamar
                                                </div>
                                                <div class="form-group"> 
                                                    <div class="select2-primary">                           
                                                        <select class="select2" multiple="multiple" data-placeholder="Select a Number" style="width: 100%;" id="noKamar" name="noKamar[]" onChange="opsi(this)">
                                                            <?php
                                                                if (count($data2) > 0) {
                                                                foreach ($data2 as $datas) {
                                                                    if($datas['status'] == 'non-active'){

                                                            ?>
                                                                <option value="<?=$datas['id']?>"><?=$datas['no_kamar']?></option>
                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="cekIn" value="<?=$value['cek_in'];?>">
                                    <input type="hidden" name="cekOut" value="<?=$value['cek_out'];?>">
                                    <input type="hidden" name="idKategori" value="<?=$value['id_kategori'];?>">                      
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="row mb-4 mt-3">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-secondary" name="btnConfirm">Konfirmasi</button>
                            </div>
                        </div>
                    </form> 
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- BS-Stepper -->
    <script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })
        })
    </script>
    <script>
       document.addEventListener('DOMContentLoaded', function () {
            var checkbox = document.querySelector('input[type="checkbox"]');

            checkbox.addEventListener('change', function () {
                if (checkbox.checked) {
                    document.getElementById('txtSecond').value = document.getElementById('txtFirst').value;
                    document.getElementById('txtSecond1').value = document.getElementById('txtFirst1').value;
                } else {
                    document.getElementById('txtSecond').value = '';
                    document.getElementById('txtSecond1').value = '';
                }
            });
        });
    </script>
</body>
</html>