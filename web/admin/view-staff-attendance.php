<?php
session_start();
$page = "Staff";
$page1 = "Staff Attendance";
include "timeout.php";
include "config.php";
$date=date("Y-m-d");
$user_id = $_SESSION['user_id'];
$time=date('h:iA');



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php
	  					$id = $_GET['id'];

                    $sql1 = "select a.*,b.full_name from attendance a,users b where
                             a.user_id=b.id and a.user_id=$id";
                    $result1 = mysqli_query($conn, $sql1);
                    if ($row1 = mysqli_fetch_assoc($result1)) {
                        ?>
  <title>(<?php echo $row1['full_name']; ?>)&nbsp; Attendance Report</title>
					<?php } ?>
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
				 <div class="col-md-12">
				
		                   <div class="login-panel panel panel-default">

       <div class="box-header">
    <style>
    .btn-danger1{
        background-color:lightgray;
    }
    </style>
      <div class="box-header">
	  <?php
	  					$id = $_GET['id'];

                    $sql1 = "select a.*,b.full_name from attendance a,users b where
                             a.user_id=b.id and a.user_id=$id order by date,user_id";
                    $result1 = mysqli_query($conn, $sql1);
                    if ($row1 = mysqli_fetch_assoc($result1)) {
                        ?>
             <center> <h3 class="box-title"><b>(<?php echo $row1['full_name']; ?>)</b>&nbsp; Attendance Report...</h3> </center>
					<?php } ?>
            </div>
<br>
    <div class="row">
            <div class="col-md-12">
            </div>
   <div class="box-body">
						<div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr style="background-color: #2a6b90;color:white">
                        <th>Name</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					$id = $_GET['id'];

                    $sql = "select a.*,b.full_name from attendance a,users b where
                             a.user_id=b.id and a.user_id=$id order by date,user_id";
                    $result = mysqli_query($conn, $sql);
                    $old_date=0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if($old_date!=$row['date']){
                            echo "";
                        }
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['full_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['time_in']; ?>
                            </td>
                            <td>
                                <?php echo $row['time_out']; ?>
                            </td>
							<td>
                                <?php echo $row['date']; ?>
                            </td>
                        </tr>
                        <?php
                        $old_date=$row['date'];
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
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

<script type="text/javascript" src="datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="datatable/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="datatable/buttons.flash.min.js"></script>
<script type="text/javascript" src="datatable/jszip.min.js"></script>
<script type="text/javascript" src="datatable/pdfmake.min.js"></script>
<script type="text/javascript" src="datatable/vfs_fonts.js"></script>
<script type="text/javascript" src="datatable/buttons.html5.min.js"></script>

<link type="text/css" href="datatable/jquery.dataTables.min.css" rel="stylesheet">
<link type="text/css" href="datatable/buttons.dataTables.min.css" rel="stylesheet">
<script>
 
  
  $(document).ready(function() {
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
             'excel'
        ]
    } );
} );
  
</script>
</body>
</html>

