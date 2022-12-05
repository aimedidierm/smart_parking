<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require 'php-includes/connect.php';
function getToken() {
    $curl = curl_init();
  
    curl_setopt_array($curl, array(
      CURLOPT_URL => BASE_URL . '/auth/agents/authorize',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{"client_id": "351cc702-749f-11ed-88fb-dead64802bd2","client_secret": "31cb490f28fa65a5ff6f709771b0e907da39a3ee5e6b4b0d3255bfef95601890afd80709"}',
      CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
    ));
  
    $response = curl_exec($curl);
  
    curl_close($curl);
  
    return json_decode($response)->access;
}
if(isset($_POST['pay'])){
    $card=$_POST['card'];
    $number=$_POST['phone'];
    $amount=$_POST['amount'];
    $query = "SELECT * FROM user WHERE card= ? limit 1";
    $stmt = $db->prepare($query);
    $stmt->execute(array($card));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount()>0) {
        //some codes here
        $myid=$rows['id'];
        $balance=$rows['balance'];
        $req = '{"amount":'.$amount.',"number":"'.$number.'"}';
    define('BASE_URL', 'https://payments.paypack.rw/api');
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => BASE_URL . '/transactions/cashin?Idempotency-Key=OldbBsHAwAdcYalKLXuiMcqRrdEcDGRv',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $req,
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . getToken(),
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    //echo $response;
    //Insert data in database
    $newbalance=$balance+$amount;
    $sql ="UPDATE user SET balance = ? WHERE id = ? limit 1";
    $stm = $db->prepare($sql);
    if ($stm->execute(array($newbalance,$myid))) {
        //continue
        $sql ="INSERT INTO transactions (debit,user) VALUES (?,?)";
        $stm = $db->prepare($sql);
        if ($stm->execute(array($amount,$myid))) {
            print "<script>alert('Money send');window.location.assign('send.php')</script>";
        } else {
            print "<script>alert('Transaction history add fail');window.location.assign('send.php')</script>";
        }
    } else{
        print "<script>alert('Balance update fail');window.location.assign('send.php')</script>";
    }
    } else {
        echo "<script>alert('User not found');window.location.assign('send.php')</script>";
    }
}
?>
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
      <form method="post">
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
            <button type="submit" name="pay" class="btn btn-success btn-block">Send money</button>
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