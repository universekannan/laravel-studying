<?php
session_start();
$page = "Students";
$page1 = "Class";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin") && ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "staff")) header("location: index.php");
$class_id=$_GET['id'];
$msg = "";
$msg_color = "";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>All Student List</title>
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
             <center> <h3>Student Details...</h3> </center>
            <hr>
            </div>
   <div class="box-body">
                         <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr style="background-color: #2a6b90;color:white">
                            <th>Roll Number</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Email</th>
                            <th>Date Of Birth</th>
                            <th>Status</th>

                            <th width="220px">Action</th>
                          

                                        </tr>
                                    </thead>
                                       <tbody>
                        <?php
                        if($_SESSION['user_type']=="admin"){
                             $sql = "select a.*,b.section_name,standard from student_record a,class b where a.class_id=b.id and a.class_id='$class_id'";
                        }
                        else if($_SESSION['user_type']=="principal"){
                          $sql = "select a.*,b.section_name,standard from student_record a,class b where a.class_id=b.id and a.class_id='$class_id'";
                      }
                      else if($_SESSION['user_type']=="staff"){
                        $sql = "select * from student_record where  class_id=$class_id";
                    }
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
							
                                 <td><?php echo $row['id']; ?></td>
                                 <td><?php echo $row['full_name']; ?></td>
                                 <td><?php echo $row['father_name']; ?></td>

                                <td><?php echo $row['email']; ?></td>


                                <td><?php echo $row['date_of_birth']; ?></td>


                                <td><?php echo $row['status']; ?></td>
 
                                <td>
								<a class="btn btn-info fa fa-edit" title="Edit Student Profile" href="edit-student-profile.php?id=<?php echo $row['id']; ?>"></a>
								<a class="btn btn-info fa fa-user" title="Student Profile" href="view-student-record.php?id=<?php echo $row['school_id']; ?>"></a>
								<a class="btn btn-info fa fa-calendar" title="Student Attendance" href="view-student-attendance.php?id=<?php echo $row['school_id']; ?>"></a>
								<a class="btn btn-info fa fa-usd" title="Student Fees" href="fees-list.php?id=<?php echo $row['school_id']; ?>"></a>
								<?php if($_SESSION['user_type']=="staff"){ ?>
								<a class="btn btn-info fa fa-plus" title="Add Student Mark" href="add-student-markdetails.php?id=<?php echo $row['id']; ?>"></a>
								<?php } ?>
								<?php if(($_SESSION['user_type']=="admin") || ($_SESSION['user_type']=="principal") || ($_SESSION['user_type']=="staff")){ ?>
								<a class="btn btn-info fa fa-check" title="Student Mark" href="view-student-mark.php?id=<?php echo $row['school_id']; ?>"></a>
								<?php } ?>
								
								</td>
                                
 
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
