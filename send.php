<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Smart parking MS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index2.html" class="h1">Smart parking MS</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Send money to card</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="text" name="card" class="form-control" placeholder="Enter card number">
          <div class="input-group-append">
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="number" name="amount" class="form-control" placeholder="Enter amount">
          <div class="input-group-append">
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="number" name="phone" class="form-control" placeholder="Enter momo number">
          <div class="input-group-append">
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-success btn-block">Send money</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>