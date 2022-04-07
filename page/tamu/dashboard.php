<?php 

    $data = $dtp->select2("tb_hotel");
    $data1 = $dtp->select("tb_fasilitas_hotel");
    $data2 = $dtp->select("tb_kategori");
    $data6 = $dtp->select("tb_lokasi");
    $data7 = $dtp->select("tb_foto_hotel");

    if(isset($_POST['btnReservasi'])){
        if(isset($_SESSION['reservasi'])){
            $item_array =array(
                'cek_in' => $_POST['check_in'],
                'cek_out' => $_POST['check_out'],
                'qty' => $_POST['qty_kamar'],
                'id_kategori' => $_POST['btnReservasi']
            );
            $_SESSION['reservasi'][0] = $item_array;      
            print_r($_SESSION['reservasi']);
        }else{
            $item_array =array(
                'cek_in' => $_POST['check_in'],
                'cek_out' => $_POST['check_out'],
                'qty' => $_POST['qty_kamar'],
                'id_kategori' => $_POST['btnReservasi']
            );
            $_SESSION['reservasi'][0] = $item_array;      
            print_r($_SESSION['reservasi']);
        };
        echo'<script>window.location="index.php?page=order"</script>';
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Da Hotel | Dashboard</title>
</head>
<style>
    #navbar-fixed {
    border-bottom: 1px solid #4b545c;
    width: 100%;
    height: 70px;
    position: sticky;
    z-index: 800;
    top: 0;
    left: 0;
    }
    input {
    padding:10px;
    font-family: FontAwesome, "Open Sans", Verdana, sans-serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
    border-radius: 0 !important;
    }

    .form-control {
    border-radius: 0 !important;
    font-size: 12x;
    }

    .clickable { cursor: pointer; }
</style>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
    <div class="wrapper">
        <form action="" method="POST">
            <nav class="main-header navbar navbar-expand-md navbar-dark navbar-gray" id="navbar-fixed">
                <div class="container">
                    <div class="col-12">
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <a class="link-black" title="CEK IN">
                                                <i class="far fa-calendar-alt"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <input id="dp1" type="text" class="form-control clickable input-md" id="DtChkIn" placeholder="Check-In" name="check_in" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <a class="link-black" title="CEK OUT">
                                                <i class="far fa-calendar-alt"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <input id="dp2" type="text" class="form-control clickable input-md" id="DtChkOut" placeholder="Check-Out" name="check_out" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <a class="link-black" title="CEK OUT">
                                                <i class="fas fa-columns"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <input type="text" class="text-center form-control" name="qty_kamar" placeholder="jumlah-kamar..."required autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <a href="#timeline" class="btn btn-default btn-block" data-toggle="tab">Pilih Kamar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper bg-white">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Da <small>Hotel</small></h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
        
                                    <div class="col-sm-6">
                                        <img class="img-fluid" src="img/<?=$data7[0]['foto']?>" alt="Photo">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img class="img-fluid mb-3" src="img/<?=$data7[1]['foto']?>" alt="Photo" style="width:100%; height: 174px !important;">
                                                <img class="img-fluid" src="img/<?=$data7[2]['foto']?>" alt="Photo" style="width:100%; height: 174px !important;">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">
                                                <img class="img-fluid mb-3" src="img/<?=$data7[3]['foto']?>" alt="Photo" style="width:100%; height: 174px !important;">
                                                <img class="img-fluid" src="img/<?=$data7[4]['foto']?>" alt="Photo" style="width:100%; height: 174px !important;">
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills" id="myTab">
                                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Informasi Umum</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Kamar</a></li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane show" id="activity">
                                                <h1>
                                                    Da Hotel
                                                    <span class="text-sm text-warning"><i class="fas fa-star"></i></span>
                                                    <span class="text-sm text-warning"><i class="fas fa-star"></i></span>
                                                    <span class="text-sm text-warning"><i class="fas fa-star"></i></span>
                                                </h1>
                                                <p>Jl. Gatot Subroto Barat , Denpasar, Denpasar, Bali, Indonesia, 80117</p>
                                                <hr>
                                                <h5>Fasilitas Utama</h5>
                                                <div class="mt-3 mx-2 row text-center">
                                                <?php
                                                    foreach ($data1 as $datas) {
                                                ?>
                                                    <a href="#" class="text-gray col">
                                                        <img src="img/<?=$datas['foto']?>" alt="" style="width:30px">
                                                        <br>
                                                        <?=$datas['nama_fasilitas']?>
                                                    </a>
                                                <?php
                                                    }
                                                ?>
                                                </div>
                                                <hr>
                                                <h5>Tentang Akomodasi</h5>
                                                <dl class="row mt-3">
                                                    <dt class="col-sm-4">Waktu check-in & check-out</dt>
                                                        <dd class="col-sm-8">Waktu check-in: 14:00-23:59 Waktu check-out: 12:00</dd>
                                                    <dt class="col-sm-4">Kebijakan</dt>
                                                        <dd class="col-sm-8">Anak</dd>
                                                        <dd class="col-sm-8 offset-sm-4">Tamu umur berapa pun bisa menginap di sini. 12 tahun ke atas dianggap sebagai tamu dewasa. Pastikan umur anak yang menginap sesuai dengan detail pemesanan. Jika berbeda, tamu mungkin akan dikenakan biaya tambahan saat check-in.</dd>
                                                        <dd class="col-sm-8 offset-sm-4">Hewan Peliharaan</dd>
                                                        <dd class="col-sm-8 offset-sm-4">Hewan peliharaan tidak dibolehkan</dd>
                                                    <dt class="col-sm-4">Deskripsi</dt>
                                                        <dd class="col-sm-8"><?=$data['keterangan']?></dd>
                                                </dl>
                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="timeline">
                                            <?php
                                                
                                                if (count($data2) > 0) {
                                                foreach ($data2 as $datas1) {
                                                                                              
                                            ?>                                    
                                                <div class="card elevation-3 card-light">
                                                    <div class="card-header">
                                                        <h1 class="card-title"><?=$datas1['nama_kategori']?></h1>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-6">
                                                                <div class="col-12">
                                                                    <img src="img/<?=$datas1['foto_kategori']?>" class="product-image product-image<?=$datas1['id_kategori']?>" alt="Product Image">
                                                                </div>
                                                                <div class="col-12 product-image-thumbs">
                                                                <?php
                                                                    $data4 = $dtp->selectWhere2("tb_foto_kamar","id_kategori",$datas1['id_kategori']);
                                                                    if (count($data4) > 0) {
                                                                    foreach ($data4 as $datas3) {
                                                                ?>
                                                                    <div class="product-image-thumb product-image-thumb<?=$datas1['id_kategori']?>">
                                                                        <img src="img/<?=$datas3['foto']?>" alt="Product Image" style="width:100%; height: 50px !important;">
                                                                    </div>

                                                                    <!-- jQuery -->
                                                                    <script src="plugins/jquery/jquery.min.js"></script>
                                                                    <!-- jQuery UI 1.11.4 -->
                                                                    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            $('.product-image-thumb<?=$datas1['id_kategori']?>').on('click', function () {
                                                                                var $image_element = $(this).find('img')
                                                                                $('.product-image<?=$datas1['id_kategori']?>').prop('src', $image_element.attr('src'))
                                                                                $('.product-image-thumb<?=$datas1['id_kategori']?>.active').removeClass('active')
                                                                                $(this).addClass('active')
                                                                            })
                                                                        })
                                                                    </script>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <h5 class="text-muted">Harga Kamar</h5>
                                                                <div class="bg-light py-2 px-3 my-4">
                                                                    <h1 class="mx-3"><small>Rp. </small><?=number_format($datas1['harga'], 0, ',', '.')?></h1>
                                                                </div>
                                                                
                                                                <h5 class="text-muted">Fasilitas</h5>
                                                                <ul class="list-unstyled mx-3">
                                                                <?php
                                                                    $data3 = $dtp->selectWhere2("tb_fasilitas_kamar","id_kategori",$datas1['id_kategori']);
                                                                    if (count($data3) > 0) {
                                                                    foreach ($data3 as $datas2) {
                                                                ?>
                                                                    <li>
                                                                        <i class="fas fa-check mr-2"></i> <?=$datas2['nama_fasilitas']?>
                                                                    </li>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                                </ul>
                                                                <?php
                                                                    $data5 = $dtp->getCountRowsDouble("tb_kamar","id_kategori",$datas1['id_kategori'],"status","non-active");  
                                                                    if($data5 == 0 ){      
                                                                ?>
                                                                    <button type="submit" class="btn btn-primary btn-lg btn-flat" name="btnReservasi" value="<?=$datas1['id_kategori']?>" disabled>
                                                                        <i class="fa fa-envelope-open-text fa-lg mr-2"></i>
                                                                        Reservasi 
                                                                    </button>
                                                                    <div class="ribbon-wrapper ribbon-xl">
                                                                        <div class="ribbon bg-danger text-xl">
                                                                        Sold Out!
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <div class="mt-4">
                                                                        <button type="submit" class="btn btn-primary btn-lg btn-flat" name="btnReservasi" value="<?=$datas1['id_kategori']?>">
                                                                            <i class="fa fa-envelope-open-text fa-lg mr-2"></i>
                                                                            Reservasi
                                                                        </button>
                                                                    </div>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                            <?php
                                                    }
                                                }
                                            ?>
                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="col-md-3">
                                <!-- Profile Image -->
                                <div class="card">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class=" img-fluid" src="dist/img/maps.png" style="width:100%; height: 150px !important;">
                                        </div>
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b><i class="fas fa-medal mr-1"></i> Lokasi Bagus</b>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fas fa-parking mr-1"></i> Parkir</b> <a class="float-right">GRATIS</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Landmark wisata</b>
                                                <ul class="list-unstyled">
                                                    <?php
                                                        foreach($data6 as $datas){
                                                    ?>
                                                    <li>
                                                        <small><?=$datas['list']?> <a class="float-right"><?=$datas['jarak']?></a></small>
                                                    </li>
                                                    <?php
                                                                                                                
                                                        }
                                                    ?>
                                                </ul>      
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
        </form>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        
    </div>
    <!-- ./wrapper -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dp1').datepicker({

        beforeShowDay: function(date) {
            return date.valueOf() >= now.valueOf();
        },
        autoclose: true

        }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {

            var newDate = new Date(ev.date);
            newDate.setDate(newDate.getDate() + 1);
            checkout.datepicker("update", newDate);

        }
        $('#dp2')[0].focus();
        });


        var checkout = $('#dp2').datepicker({
        beforeShowDay: function(date) {
            if (!checkin.datepicker("getDate").valueOf()) {
            return date.valueOf() >= new Date().valueOf();
            } else {
            return date.valueOf() > checkin.datepicker("getDate").valueOf();
            }
        },
        autoclose: true

        }).on('changeDate', function(ev) {});
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