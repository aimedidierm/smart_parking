<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require '../php-includes/connect.php';
require 'php-includes/check-login.php';
if(isset($_POST['save'])){
    $names=$_POST['names'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $card=$_POST['card'];
    $sql ="INSERT INTO user (names, card, email, phone, balance) VALUES (?,?,?,?,'0')";
    $stm = $db->prepare($sql);
    if ($stm->execute(array($names,$card,$email,$phone))) {
        print "<script>alert('User added');window.location.assign('customers.php')</script>";

    } else{
        echo "<script>alert('Error! try again');window.location.assign('customers.php')</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Smart parking | Customers</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<?php require 'php-includes/nav.php';?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customers management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customers</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Names</th>
                    <th>Card</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Balance</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql = "SELECT * FROM user";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        $count = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                  <tr>
                    <td><?php print $row['names']?></td>
                    <td><?php print $row['card']?></td>
                    <td><?php print $row['email']?></td>
                    <td><?php print $row['phone']?></td>
                    <td><?php print $row['balance']?></td>
                    <td><form method="post"><button type="submit" class="btn btn-danger" id="<?php echo $row["id"];$sid=$row["id"]; ?>" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete</button></form></td>
                  </tr>
                  <?php
                        $count++;
                        }
                    }
                    if(isset($_POST['delete'])){
                        $sql ="DELETE FROM user WHERE id = ?";
                        $stm = $db->prepare($sql);
                        if ($stm->execute(array($sid))) {
                            print "<script>alert('user deleted');window.location.assign('customers.php')</script>";
                
                        } else {
                            print "<script>alert('Delete fail');window.location.assign('customers.php')</script>";
                        }
                    }
                    ?>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <section class="content">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <h1>Add new cuctomer</h1>
                <form method="post">
                    <div class="form-group">
                        <label>Names</label>
                        <input class="form-control" type="text" name="names" required>
                    </div>
                    <div class="form-group">
                        <label>Card</label>
                        <input class="form-control" type="text" name="card" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control" type="number" name="phone" required>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success" name="save"><span class="glyphicon glyphicon-check"></span> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </section>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>