<?php
  session_start();
  include "config/kontrol.php";
  $lg = new pesan();

  $table = "tb_user";
  if ($lg->sessionCheck() == "true") {
    if (@$_SESSION['level'] == "admin") {
      header("location:pageAdmin.php");
    } else if (@$_SESSION['level'] == "resepsionis") {
      header("location:pageResepsionis.php");
    }
  }

  if(isset($_POST["btnLogin"])) {
      $username =  strtolower($_POST["tfUsername"]);
      $password = $_POST["tfPassword"];

      if ($username == "" || $password == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Field !!!'];
      }else if($response = $lg->login_admin("tb_user", $username, $password)){
        if ($response['response'] == "positive") {
            $_SESSION['username'] = $_POST['tfUsername'];
            $_SESSION['level']    = $response['level'];
            if ($response['level'] == "admin") {
                $response = $lg->redirect("pageAdmin.php");
            } else if ($response['level'] == "resepsionis") {
                $response = $lg->redirect("pageResepsionis.php");
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
  <title>Da Hotel | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" href="dist/css/sweet-alert.css">
</head>
<body class="hold-transition login-page" class="hold-transition login-page" style="background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('img/164852180510.jpg') no-repeat; background-size: cover;">
<div class="login-box">
  <div class="login-logo">
    <a href="" class="text-white"><b>Da</b>Hotel</a>
  </div>
  <!-- /.login-logo -->
  <div class="card card-outline card-secondary pt-3 pb-3 elevation-3">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in</p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="tfUsername" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
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
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="btnLogin">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1 pt-3">
        <a href="pageRegistrasi.php" class="text-center">Register a new Resepsionis or Admin</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script src="dist/js/sweetalert.min.js"></script>
<?php include "config/alert.php";?>

</body>
</html>
