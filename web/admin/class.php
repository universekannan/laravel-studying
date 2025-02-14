<?php
session_start();
$page = "users";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "staff"))  header("location: index.php");
$page = "Class";
$msg = "";
$msg_color = "";
$id=$_GET['id'];

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> View Class</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

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

				 <div class="col-xs-12">
				
		                   <div class="login-panel panel panel-default">

						<div class="table-responsive">
       <div class="box-header">
	                           <?php
                        if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type'] == "principal") || ($_SESSION['user_type'] == "staff")){
                            $sql = "select a.*,b.section_name,standard from student_record a,class b where a.class_id=b.id and a.class_id='$id'";
                        }
                        $result = mysqli_query($conn, $sql);
                        if ($row = mysqli_fetch_assoc($result)) {
                            ?>
             <center> <h3 class="box-title"><?php echo $row['standard']; ?>  <?php echo $row['section_name']; ?></h3> </center>
			  <?php

                        }
                        ?>
            </div>

                         <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr style="background-color: #81888c;color:white">
                            <th>Roll Number</th>
                            <th>Student Name</th>
                            <th>Father Name</th>

                            <th width="250px" style="text-align:right">Action</th>
                                        </tr>
                                    </thead>
                                       <tbody>
                        <?php
                        if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type'] == "principal")){
                            $sql1 = "select a.*,b.section_name,standard from student_record a,class b where a.class_id=b.id and a.class_id='$id'";
                        }
                        $result1 = mysqli_query($conn, $sql1);
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            ?>
                            <tr> 
							     <td>SMRV<?php echo $row1['standard']; ?><?php echo $row1['section_name']; ?><?php echo $row1['school_id']; ?></td>
							     <td><?php echo $row1['full_name']; ?></td>
							     <td><?php echo $row1['father_name']; ?></td>
                                <td><a title="Attendance" class="btn btn-info fa fa-calendar" href="view-student-attendance.php?id=<?php echo $row1['school_id']; ?>"></a>
								<a title="Student Mark" class="btn btn-info fa fa-check" href="delete_class.php?id=<?php echo $row1['school_id']; ?>"></a>
								<a title="Student Fees Details" class="btn btn-info fa fa-usd" href="delete_class.php?id=<?php echo $row1['school_id']; ?>"></a>
								<a title="Edit" class="btn btn-info fa fa-edit" href="delete_class.php?id=<?php echo $row1['school_id']; ?>"></a>
								<a title="Delete" class="btn btn-info fa fa-trash-o" href="delete_class.php?id=<?php echo $row1['school_id']; ?>"></a></td>
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
