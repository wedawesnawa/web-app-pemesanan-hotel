<?php
    $id = $_GET['kd'];
    
    $data4 = $dtp->select_join("tb_pelanggan","tb_reservasi","id_pelanggan",$id);
    $data5 = $dtp->selectWhere("tb_reservasi","id_pelanggan", $id);
    $data6 = $dtp->getCountRows("tb_order_kamar", "id_reservasi", $data5['id_reservasi']);
    $data2 = $dtp->selectWhere("tb_kategori", "id_kategori", $data4['id_kategori']);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Da Hotel | Print</title>
</head>
<body>
  <div class="row">
    <div class="col-12">
      <!-- Main content -->
      <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
          <div class="col-12">
            <h4>
              <i class="fas fa-globe"></i> Da Hotel
              <small class="float-right">Date: <?=date("d/m/Y")?></small>
            </h4>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                <strong>Resepsionis Da Hotel</strong><br>
                <b>Email :</b> da_hotel@gmail.com<br>
                <b>Phone :</b> 087899509370<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                <strong><?=$data4['nama_tamu']?></strong><br>
                Phone: <?=$data4['no_tlp']?><br>
                Email: <?=$data4['email']?>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Reservasi #<?=$data4['id_reservasi']?></b><br>
                <br>
                <b>User ID:</b> <?=$data4['id_pelanggan']?><br>
                <b>Date Reservasi:</b> <?=$data4['tgl_reservasi']?><br>
                <b>No Kamar:</b>  
                <?php
                    $data3 = $dtp->selectWhere2("tb_order_kamar", "id_reservasi", $data5['id_reservasi']);
                    foreach($data3 as $dta3){
                        $data7 = $dtp->selectWhere2("tb_kamar", "id", $dta3['id']);
                        foreach($data7 as $dta){
                ?>
                    | <?=$dta['no_kamar']?> |
                <?php
                        }
                    }
                ?><br>
            </div>
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-striped">
              <thead>
              <tr>
                <th>Jumlah Kamar</th>
                <th>Type Kamar</th>
                <th>Cek In</th>
                <th>Cek Out</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td><?=$data6?></td>
                <td><?=$data2['nama_kategori']?></td>
                <td><?=$data4['cek_in']?></td>
                <td><?=$data4['cek_out']?></td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- this row will not appear when printing -->
      </div>
      <!-- /.invoice -->
    </div>
  </div>
    <script>
    window.addEventListener("load", window.print());
    </script>
</body>
</html>