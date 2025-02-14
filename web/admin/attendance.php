<?php
session_start();
error_reporting(0);
$page = "Students";
$page1 = "Student Attendance";
include "timeout.php";
include "config.php";
if (($_SESSION['user_type'] != "admin")&& ($_SESSION['user_type'] != "principal") && ($_SESSION['user_type'] != "staff"))  header("location: index.php");
$user_id=$_SESSION['user_id'];
$id=$_GET['id'];

$msg = "";
$msg_color = "";
$status="";


if (isset($_POST['submit'])) {

    $school_id_arr = $_POST['school_id'];
    $status_arr = $_POST['status'];
   
   

   for($i=0;$i<count($school_id_arr);$i++){
    $school_id = mysqli_real_escape_string($conn, $school_id_arr[$i]);
    $status = mysqli_real_escape_string($conn, $status_arr[$i]);  
    
    $date = date("Y/m/d");
    
  
        $stmt = $conn->prepare("INSERT INTO student_attendance (school_id,class_id,status,user_id,date) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss",$school_id,$class_id=$id,$status,$user_id,$date);
        $stmt->execute() or die($stmt->error);
		$id = $stmt->insert_id;
       
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>View Class Teacher</title>
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

              
				 <div class="col-xs-12">
				
		                   <div class="login-panel panel panel-default">

						<div class="table-responsive">
       <div class="box-header">
	    <?php 
                             $sql = "select a.*,b.section_name,standard from student_record a,class b where a.class_id=b.id and a.class_id='$id'";
							   $result = mysqli_query($conn, $sql);
                        if ($row = mysqli_fetch_assoc($result)) {
                            ?>
             <center> <h3><?php echo $row['standard']; ?><?php echo $row['section_name']; ?> Attendance</h3> </center>
			   <?php } ?>
          <hr>
            </div>
   <div class="box-body">
<form action ="" method="post">
                         <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr style="background-color: #2a6b90;color:white">
							<th>Roll Number</th>
                            <th>Student Name</th>
                            
		
                            <th width="50px" style="text-align:right">Status</th>
                                        </tr>
                                    </thead>
                                       <tbody>
									   
                        <?php if($_SESSION['user_type']=="admin"){
                             $sql = "select a.*,b.section_name,standard from student_record a,class b where a.class_id=b.id";

                           // $sql = "select * from student_record";
                                }
                                else if($_SESSION['user_type']=="principal"){
								$sql = "select a.*,b.section_name,standard from student_record a,class b where a.class_id=b.id";                                }
                                else if($_SESSION['user_type']=="staff"){
                             $sql = "select a.*,b.section_name,standard from student_record a,class b where a.class_id=b.id and a.class_id='$id'";
                                }
                       $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr> 
							                <td>SMRV<?php echo $row['standard']; ?><?php echo $row['section_name']; ?><input readonly style="border:0px solid;background-color:transparent" value="<?php echo $row['school_id'];?>" name="school_id[]" class="main"/></td>								 
							                								 

							                <td><?php echo $row['full_name'];?></td>								
											<!--<td><input readonly style="border:0px solid;background-color:transparent" value="<?php echo $row['father_name'];?>" name="father_name[]"/></td>-->	
											
											
							<td><input type="checkbox"  name="status[]"  value="Absent"/></td>
              
                            </tr>
                        <?php

                        }
                        ?>
                                        </tbody>
									</table><center><input type="submit" class="btn btn-primary" name="submit" value="Submit"/></center></form>
									<!-- /.box --><br>
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
