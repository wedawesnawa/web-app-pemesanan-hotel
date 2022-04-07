<?php

  include "config/kontrol.php";

  $rg = new pesan();
  $table    = "tb_user";
  $autokode = $rg->autokode("tb_user", "id_user", "US");

  if(isset($_POST["btnRegister"])) {
    $idUser = $_POST['userId'];
    $nama = $_POST["tfName"];
    $username = $_POST["tfUsername"];
    $email = $_POST["email"];
    $password = $_POST["tfPassword"];
    $confirm = $_POST["tfPassword2"];
    $redirect = "loginMulti.php";
    $level = $_POST["tfRole"];

    if ($nama == "" || $username == "" || $email == "" || $level == "" || $confirm == "") {
      $response = ['response' => 'negative', 'alert' => 'Lengkapi Field !!!'];
    }else{
      $response = $rg->register("tb_user", $idUser, $nama, $email, $username, $password, $level, $confirm, $redirect);
    }

  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Da Hotel | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="dist/css/sweet-alert.css">
  <style>
    .select2{
      color: #a3b2b9;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
    }
  </style>
</head>
<body class="hold-transition register-page" class="hold-transition login-page" style="background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('img/164852180510.jpg') no-repeat; background-size: cover;">
<div class="register-box">
  <div class="register-logo">
    <a href="index2.html" class="text-white"><b>Da</b>Hotel</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new account</p>

      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" readonly value="<?=$autokode;?>" name="userId">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="tfName">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="tfUsername">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-at"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="tfPassword">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="tfPassword2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select class="form-control select2" name="tfRole">
              <option disabled selected>Select the Role....</option>
              <option value="admin">Admin</option>
              <option value="resepsionis">Resepsionis</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-tie"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="btnRegister">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1 pt-3">
        <a href="index.php" class="text-center">I already have a membership</a>
      </p>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="dist/js/sweetalert.min.js"></script>
<?php include "config/alert.php";?>

</body>
</html>
