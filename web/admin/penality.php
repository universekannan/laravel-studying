<?php
session_start();
$page = "student-record";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "library")) header("location: index.php");
$msg = "";
$msg_color = "";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Penality</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dataTables.responsive.css">
<script src="css/dataTables.responsive.js"></script>
  <link rel="stylesheet" href="css/dataTables.responsive.scss">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

     <?php include "header.php"; ?>

    <?php include "menu.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
 <br /> 
                
				 <div class="col-xs-12">
				
		                   <div class="login-panel panel panel-default">

						<div class="table-responsive">
       <div class="box-header">
             <center> <h3 class="box-title">Penality...</h3> </center>
            </div>

                         <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr style="background-color: #81888c;color:white">
                             <th>Full Name</th>
                            <th>Class Name</th>
                            <th>Book ID</th>
                            <th>Book Name</th>
                            <th>Author Name</th>
                            <th>Penality Amount</th>
                            <th>Penality Date</th>
                            <th>Status</th>
                            <th width="50px" style="text-align:right">Delete</th>
                                        </tr>
                                    </thead>
                                       <tbody>
                        <?php
                         if($_SESSION['user_type']=="admin"){
                          $sql = "select a.*,b.section_name,standard,c.full_name from penality a,class b,student_record c where a.class_id=b.id and  a.school_id=c.school_id";
                      }
                        else if($_SESSION['user_type']=="principal"){
                            $sql = "select * from penality";
                        }
                        else if($_SESSION['user_type']=="library"){
                          $sql = "select * from penality";
                      }
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                            <td><?php echo $row['full_name']; ?></td>

                                 <td><?php echo $row['standard']; ?><?php echo $row['section_name']; ?></td>


                                <td><?php echo $row['book_id']; ?></td>
                                <td><?php echo $row['book_name']; ?></td>
                                <td><?php echo $row['author_name']; ?></td>

                                <td><?php echo $row['penality_amount']; ?></td>

                                <td><?php echo $row['penality_date']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td><a class="btn btn-info fa fa-trash-o" href="delete-penality.php?id=<?php echo $row['id']; ?>"></a></td>
                            </tr>
                        <?php

                        }
                        ?>
                        </tbody>
                                        </tbody>
									</table>
									<!-- /.box -->
 </div>
            </div>
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

      <?php include "footer.php"; ?>

  <!-- Control Sidebar -->
     
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
